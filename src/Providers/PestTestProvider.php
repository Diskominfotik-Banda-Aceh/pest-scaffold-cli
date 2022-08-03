<?php
namespace DiskominfotikBandaAceh\PestScaffoldCli\Providers;

use Illuminate\Support\ServiceProvider;

class PestTestProvider extends ServiceProvider {

    protected $commands = [
        'DiskominfotikBandaAceh\PestScaffoldCli\Commands\PestTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\Commands\PestCreateTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\Commands\PestReadTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\Commands\PestUpdateTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\Commands\PestDeleteTest',
    ];

    public function register(){
        $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}

?>
