<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Unidade;
use App\Estado;
use App\Cidade;
use Validator;
use Hash;

/**
 * Controller herdado pelos demais controllers
 * com as operacoes básicas de CRUD.
 */
class CommonController extends Controller
{

    /**
     * Action responsavel por pegar todos os registro da Model
     * em questao e retornar.
     *
     * @return json
     */
    public function index()
    {
        $banco = $this->banco;
        $banco = $banco::orderBy('id', 'asc')->get();

        if (!$banco->isEmpty()) {
            return response()->json($banco);
        }

        $jsonRetorno['sucesso'] = false;
        $jsonRetorno['message'] = 'Não existe registros.';
        return response()->json($jsonRetorno);
    }

    /**
     * Action responsavel por retornar um registro da Model de acordo com o filtro.
     *
     * @param int $id Campo da coluna 'id' na tabela
     * @return json
     */
    public function filtroPorId($id)
    {
        $banco = $this->banco;
        $banco = $banco::find($id);

//        if ($banco->exists) {
        if (count($banco) >= 1) {
            return response()->json($banco);
        }

        $jsonRetorno['sucesso'] = false;
        $jsonRetorno['message'] = 'Não existe registro.';
        return response()->json($jsonRetorno);
    }

    /**
     * Action responsavel por retornar uma ou mais registros
     * da Model de acordo com o filtro geral.
     *
     * @param string $campo Coluna para ser filtrada.
     * @param string $valor Valor da coluna para ser filtrada.
     * @return json
     */
    public function filtroGeral($campo, $valor)
    {
        $banco = $this->banco;
        $banco = $banco::where($campo, 'like', '%'.$valor.'%')->get();

        if (!$banco->isEmpty()) {
            return response()->json($banco);
        }

        $jsonRetorno['sucesso'] = false;
        $jsonRetorno['message'] = 'Nada encontrado.';
        return response()->json($jsonRetorno);
    }

    /**
     * Action responsavel por salvar um registro.
     *
     * @param string $request requisição post.
     * @return json
     */
    public function salvar(Request $request)
    {
        $jsonRetorno = array();

        $validacao = Validator::make($request->all(), $this->array);

        if ($validacao->fails()) {
            $jsonRetorno['sucesso']   = false;
            $jsonRetorno['message']   = $this->msgSaveFields;
            $jsonRetorno['validacao'] = $validacao->errors()->all();

            return response()->json($jsonRetorno);
        }

        $action = $this->actionComplement($request);

        if (!$action['sucesso']) {
            return response()->json($action);
        }

        $model       = $this->banco;
        $registroNew = new $model;

        $max = sizeof($this->arrayFields);

        foreach ($registroNew as $key => $value) {
            for ($i = 0; $i < $max; $i++) {
                $registroNew[$this->arrayFields[$i]] = $request->input($this->arrayFields[$i]);
            }
            break;
        }

        try {
            $registroNew->save();

            $jsonRetorno['sucesso'] = true;
            $jsonRetorno['message'] = "Registro salvo com sucesso.";
        } catch (Throwable $e) {
            $jsonRetorno['sucesso'] = false;
            $jsonRetorno['message'] = "Não conseguimos salvar o registro.";
        }

        return response()->json($jsonRetorno);
    }

    /**
     * Action responsavel por editar um registro.
     *
     * @param string $id vem por parametro na rota.
     * @param string $request requisição post.
     * @return json
     */
    public function editar($id, Request $request)
    {
        $jsonRetorno = array();

        $validacao = Validator::make($request->all(), $this->array);

        if ($validacao->fails()) {
            $jsonRetorno['sucesso']   = false;
            $jsonRetorno['message']   = $this->msgEditFields;
            $jsonRetorno['validacao'] = $validacao->errors()->all();

            return response()->json($jsonRetorno);
        }

        $action = $this->actionComplement($request);

        if (!$action['sucesso']) {
            return response()->json($action);
        }

        $model = $this->banco;

        try {
            $registro = $model::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $jsonRetorno['sucesso'] = false;
            $jsonRetorno['message'] = $this->msgEditNotFind;

            return response()->json($jsonRetorno);
        }

        $max = sizeof($this->arrayFields);

        foreach ($registro as $key => $value) {
            for ($i = 0; $i < $max; $i++) {
                $registro[$this->arrayFields[$i]] = $request->input($this->arrayFields[$i]);
            }
            break;
        }

        try {
            $registro->save();

            $jsonRetorno['sucesso'] = true;
            $jsonRetorno['message'] = $this->msgEditsuccess;
        } catch (Throwable $e) {
            $jsonRetorno['sucesso'] = false;
            $jsonRetorno['message'] = "Não conseguimos editar o registro.";
        }

        return response()->json($jsonRetorno);
    }

    /**
     * Action responsavel por receber via DELETE um ID para ser filtrado e deletado.
     *
     * @return json
     */
    public function deletar($id)
    {
        $jsonRetorno = array();

        if (empty($id) && $id != 0) {
            $jsonRetorno['sucesso'] = false;
            $jsonRetorno['message'] = 'Você deve informar um Registro para deletar.';

            return response()->json($jsonRetorno);
        }

        try {
            $banco = $this->banco;
            $banco = $banco::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $jsonRetorno['sucesso'] = false;
            $jsonRetorno['message'] = 'Não foi encontrado nenhum Registro.';

            return response()->json($jsonRetorno);
        }

        try {
            $banco->delete();

            $jsonRetorno['sucesso'] = true;
            $jsonRetorno['message'] = 'Registro deletado com Sucesso.';
        } catch (Throwable $e) {
            $jsonRetorno['sucesso'] = false;
            $jsonRetorno['message'] = "Não conseguimos editar o registro.";
        }

        return response()->json($jsonRetorno);
    }
}