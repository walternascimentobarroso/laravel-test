<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudController extends GeneratorCommand
{
    /**
     * The name and name of the console command.
     *
     * @var string
     */
    protected $name = 'make:crudcontroller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um controller que extende o CommonController';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        // HACK para achar o caminho correto do meu stubs.
        $caminho = str_replace("app/Console/Commands", "resources", __DIR__);

        return $caminho.'/stubs/controller.crud.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $namespace = $this->getNamespace($name);

        return str_replace("use $namespace\Controller;\n", '', parent::buildClass($name));
    }
}
