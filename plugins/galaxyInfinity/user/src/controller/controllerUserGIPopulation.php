<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\ManagerUserGIPopulation;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGIPopulation{

    private $ManagerUserGIPopulation;

    private $controllerBase;

    public function __construct(){

        $this->ManagerUserGIPopulation = new ManagerUserGIPopulation();

        $this->controllerBase = new ControllerBase();
    }

    public function affichePopulationUser(){
        if(isset($_SESSION['pseudo'])){
            
            $userPopulation = 'plugins/galaxyInfinity/user/src/view/userGestionPopulationView.php';
            $userPopulation = $this->controllerBase->tamponView($userPopulation);

            $this->controllerBase->afficheView([$userPopulation],'userGestionPopulation');
        }

    }

}