<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\ManagerUserGIMissions;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGIMissions{
    private $managerUserGIMissions;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIMissions = new ManagerUserGIMissions();

        $this->controllerBase = new ControllerBase();
    }


    public function afficheMissionsUser(){
        if(isset($_SESSION['pseudo'])){

            $getMissions = $this->managerUserGIMissions->getAllMissions();

            $userMissions = 'plugins/galaxyInfinity/user/src/view/userGestionMissionsView.php';
            $userMissions = $this->controllerBase->tamponView($userMissions,['missions' => $getMissions]);

            $this->controllerBase->afficheView([$userMissions],'userGestionMissions');
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
        
    
}