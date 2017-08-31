<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Todos os Controller que possuem as rotas mais comuns serão extendidos deste
 * 
 */
abstract class AbstractCommonTest extends TestCase
{

    use DatabaseTransactions,
        WithoutMiddleware;

    /**
     * Verifica o sucesso para a rota de INDEX.
     *
     * @return void
     */
    public function testIndexSuccess()
    {
        factory($this->classe)->create();

        $this->json('GET', $this->rotaIndex)->seeJsonStructure([$this->array]);
    }

    /**
     * Verifica a falha para a rota de INDEX.
     *
     * @return void
     */
    public function testIndexFailure()
    {
        $this->json('GET', $this->rotaIndex)->seeJsonEquals([
            'sucesso' => false,
            'message' => $this->msgIndexFailure
        ]);
    }

    /**
     * Verifica o sucesso para a rota de Filtro por ID.
     *
     * @return void
     */
    public function testFiltroIDSuccess()
    {
        $model = factory($this->classe)->create();

        $this->json('GET', "{$this->rotaIndex}/id/{$model['id']}")->seeJsonStructure($this->array);
    }

    /**
     * Verifica a falha para a rota de Filtro por ID.
     *
     * @return void
     */
    public function testFiltroIDFailure()
    {
        $this->json('GET', "{$this->rotaIndex}/id/0")->seeJsonEquals([
            'sucesso' => false,
            'message' => $this->msgFiltroIDFailure
        ]);
    }

    /**
     * Verifica o sucesso para a rota de Filtro Geral.
     *
     * @return void
     */
    public function testFiltroGeralSuccess()
    {
        $model = factory($this->classe)->create();

       $this->json('GET', "{$this->rotaIndex}/filtro/$this->campoFiltro/valor/{$model[$this->campoFiltro]}")->seeJsonStructure([$this->array]);
    }

    /**
     * Verifica a falha para a rota de Filtro Geral.
     *
     * @return void
     */
    public function testFiltroGeralFailure()
    {
        $this->json('GET', "{$this->rotaIndex}/filtro/$this->campoFiltro/valor/WWWWWWWW")->seeJsonEquals([
            'sucesso' => false,
            'message' => $this->msgFiltroGeralFailure
        ]);
    }

    /**
     * Verifica o sucesso para a rota de Salvar.
     *
     * @return void
     */
    public function testSalvarSuccess()
    {
        $model = factory($this->classe)->make();

        $this->json('POST', $this->rotaIndex, $model->toArray())->seeJsonEquals([
            'sucesso' => true,
            'message' => $this->msgSaveSuccess
        ]);
    }

    /**
     * Verifica a falha para a rota de Salvar.
     *
     * @return void
     */
    public function testSalvarFailure()
    {
        $this->json('POST', $this->rotaIndex, array())->seeJson([
            'sucesso' => false,
            'message' => $this->msgSaveFailure
        ]);
    }

    /**
     * Verifica o sucesso para a rota de Editar.
     *
     * @return void
     */
    public function testEditarSuccess()
    {
        $fakeModel = factory($this->classe)->make();
        $model = factory($this->classe)->create();

        $this->json('PUT', "{$this->rotaIndex}/{$model['id']}",
            $fakeModel->toArray())->seeJsonEquals([
            'sucesso' => true,
            'message' => $this->msgEditSuccess
        ]);
    }

    /**
     * Verifica a falha para a rota de Editar.
     *
     * @return void
     */
    public function testEditarFailure()
    {
        $this->json('PUT', "{$this->rotaIndex}/0", array())->seeJson([
            'sucesso' => false,
            'message' => $this->msgEditarFailure
        ]);
    }

    /**
     * Verifica o sucesso para a rota de Deletar.
     *
     * @return void
     */
    public function testDeletarSuccess()
    {
        $model = factory($this->classe)->create();

        $this->json('DELETE', "{$this->rotaIndex}/{$model['id']}")->seeJsonEquals([
            'sucesso' => true,
            'message' => $this->msgDeletarSuccess
        ]);
    }

    /**
     * Verifica a falha para a rota de Deletar.
     *
     * @return void
     */
    public function testDeletarFailure()
    {
        $this->json('DELETE', "{$this->rotaIndex}/0")->seeJsonEquals([
            'sucesso' => false,
            'message' => $this->msgDeletarFailure
        ]);
    }
}