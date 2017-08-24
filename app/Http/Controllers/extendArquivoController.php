<?php

namespace App\Http\Controllers;

use App\Banco;

/**
 * Controller responsavel por operacoes CRUD nos Bancos.
 */
class BancoController extends CommonController
{
    protected $banco;
    protected $array;
    protected $arrayFields;
    protected $msgSaveFields;
    protected $msgEditFields;
    protected $msgEditNotFind;
    protected $msgEditsuccess;

    /**
     * $banco = Variavel informado a model que sera usada
     * $array = array de campos requeridos na edição e no momento de salvar
     * $arrayFields = array de campos para inserção (for no editar e no salvar da classe common)
     * $msgSaveFields = Mensagem para quando os dados não forem preenchidos no salvar
     * $msgEditFields = Mensagem para quando os dados nao forem preenchidos no editar
     * $msgEditNotFind = Mensagem para quando o registro nao for encontrado pelo ID fornecido
     * $msgEditsuccess = Mensagem para quando o registro for alterado com sucesso
     */
    public function __construct(Banco $banco)
    {
        $this->banco          = $banco;
        $this->array          = [
            'ativo' => 'required',
            'descricao' => 'required'
        ];
        $this->arrayFields    = ['ativo', 'cod_banco', 'descricao', 'conta', 'agencia'];
        $this->msgSaveFields  = 'O campo de ativo e descricao devem ser preenchidos.';
        $this->msgEditFields  = 'Todos os campos devem ser preenchidos.';
        $this->msgEditNotFind = 'O Banco não foi encontrado.';
        $this->msgEditsuccess = 'Banco alterado com sucesso.';
    }

    /**
     * Função para complemtar as ações do editar e do metodo salvar
     * o retorno é um array com uma chave de sucesso com um valor boleano(true ou false), 
     * caso false a instrução para e informa a mensagem dentro do array, caso true, completa a função de salvar ou editar
     */
    public function actionComplement($request)
    {
        $jsonRetorno['sucesso'] = true;

        return $jsonRetorno;
    }
}
