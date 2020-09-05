<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIBatiment;

use App\config\themes\controller\controllerBase;


class ControllerUserGIBatiment{

    private $managerUserGIBatiment;

    private $controllerBase;

    public function __construct(){
        $this->managerUserGIBatiment = new ManagerUserGIBatiment();

        $this->controllerBase = new ControllerBase();
    }


    public function afficheBatimentUser(){
        if(isset($_SESSION['pseudo'])){
            $userBatiment = '../plugins/galaxyInfinity/user/src/view/userGestionBatimentView.php';
            $userBatiment = $this->controllerBase->tamponView($userBatiment);
            $this->controllerBase->afficheView([$userBatiment]);
        }
    }

}