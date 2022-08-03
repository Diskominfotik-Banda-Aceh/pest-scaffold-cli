<?php

namespace DiskominfotikBandaAceh\PestScaffoldCli\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use function base_path;

class PestUpdateTest extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:pest-update
                            {name : Model name to generate}
                            {--path=} : Path for files (default in tests"\Feature\Http\Controller")
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create of pest test scaffold for update test';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Update Test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        parent::handle();
        return 0;
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name){
        $stub = parent::buildClass($name);
        $this->replaceModel($stub);
        return $stub;
    }

    /**
     * Replace columns.
     *
     * @param string $stub
     * @return $this
     */
    public function replaceModel(&$stub){
        $stub = str_replace(
            [
                '{{modelCamelCase}}',
                '{{modelSnakeCase}}'
            ],
            [
                Str::camel(Str::plural($this->getNameInput())),
                Str::snake($this->getNameInput())
            ],
            $stub
        );
        return $this;
    }

    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'The name of the model'],
        ];
    }

    protected function getStub(){
        return $this->resolveStubPath('/../../templates/controller-update-test.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $filename = $name.'UpdateTest';
        return base_path('tests').str_replace('\\', '/', $filename).'.php';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $model = $this->argument('name');
        $path = $rootNamespace . '\Feature\Http\Controller\\'.$model.'Controller';
        return $this->option('path') ?? $path;
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Tests';
    }
}
