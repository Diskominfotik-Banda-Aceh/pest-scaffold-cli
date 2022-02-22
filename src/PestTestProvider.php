<?php
namespace DiskominfotikBandaAceh\PestScaffoldCli;

use Illuminate\Support\ServiceProvider;

class PestTestProvider extends ServiceProvider {

    protected $commands = [
        'DiskominfotikBandaAceh\PestScaffoldCli\PestTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\PestCreateTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\PestReadTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\PestUpdateTest',
        'DiskominfotikBandaAceh\PestScaffoldCli\PestDeleteTest',
    ];

    public function register(){
        $this->commands($this->commands);
    }
}

?>
