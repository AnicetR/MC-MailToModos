<?php


namespace app;

use system\Config,
    vendor\CLIFramework\CLI,
    app\models\Queries,
    app\models\Pex,
    system\Logs,
    app\helpers\onlineModos;


class Procedure extends CLI{



    public function _construct(){
        parent::__construct('MailToModos', 'Elendil', '(c) 2015 Elendil');
    }

    public function main()
    {
        print $this->launchMessage();
        $queries = new Queries(Config::$server['query_host'], Config::$server['query_port']);
        $pex = new Pex();
        $pex->getModos();
        onlineModos::get();
    }
    private function launchMessage(){
        return  $this->colorText("
            MailToModos

               / \
              / _ \
             |.o '.|
             |'._.'|
             |     |
           ,'|  |  |`.
          /  |  |  |  \
          |,-'--|--'-.|

 __                    _   _
|  |   ___ _ _ ___ ___| |_|_|___ ___
|  |__| .'| | |   |  _|   | |   | . |
|_____|__,|___|_|_|___|_|_|_|_|_|_  |
                                |___|

",

            "LIGHT_BLUE");
        }

    public function flag_v(){
        Config::$app['verbose'] = true;
        Logs::write('app','Info', "Execution en mode verbeux\n");
    }

}