<?php


namespace app;

use system\Config;
use vendor\CLIFramework\CLI;
use app\models\Queries;

class Procedure extends CLI{



    public function _construct(){
        parent::__construct('MailToModos', 'Elendil', '(c) 2015 Elendil');
    }

    public function main()
    {

        print $this->launchMessage();
        $getPlayers = new Queries(Config::$server['query_host'], Config::$server['query_port']);
        $getPlayers->getPlayersList();

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

}