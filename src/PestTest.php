<?php

namespace DiskominfotikBandaAceh\PestScaffoldCli;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class PestTest extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:pest
                            {name : Model name to generate}
                            {--crud=} : Generate specific files --crud=c,r,u,d ("u" for edit. index always be create)
                            {--path=} : Path for files (default in tests"\Feature\Http\Controller")
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all of pest test scaffold';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Index Test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        parent::handle();
        $crud = explode(',',trim($this->option('crud')));
        $model = $this->argument('name');

        if ($this->option('crud')){
            if (in_array('c', $crud)) {
                $this->generateCreate();
            }
            elseif (in_array('r', $crud)) {
                $this->generateRead();
            }
            elseif (in_array('u', $crud)) {
                $this->generateUpdate();
            }
            elseif (in_array('d', $crud)) {
                $this->generateDelete();
            }
        }
        else{
            $this->generateCreate();
            $this->generateRead();
            $this->generateUpdate();
            $this->generateDelete();
        }

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

    public function generateRead()
    {
        $this->call('make:pest-read', ['name'=>$this->getNameInput(), '--path'=>$this->option('path')]);
    }

    public function generateCreate()
    {
        $this->call('make:pest-create', ['name'=>$this->getNameInput(), '--path'=>$this->option('path')]);
    }

    public function generateUpdate()//or we called it edit
    {
        $this->call('make:pest-update', ['name'=>$this->getNameInput(), '--path'=>$this->option('path')]);
    }

    public function generateDelete()
    {
        $this->call('make:pest-delete', ['name'=>$this->getNameInput(), '--path'=>$this->option('path')]);
    }

    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'The name of the model'],
        ];
    }

    protected function getStub(){
        return $this->resolveStubPath('/stubs/controller-index-test.stub');
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
        $filename = $name.'IndexTest';
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
