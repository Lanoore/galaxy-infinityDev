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


    public function afficheBatimentUser($tier){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGIBatiment->idPlanete = $_SESSION['idPlaneteActif'];
            $this->managerUserGIBatiment->tier = $tier;
            $batPlanete = $this->managerUserGIBatiment->getBatPlanete();


            $userBatiment = '../plugins/galaxyInfinity/user/src/view/userGestionBatimentView.php';
            $userBatiment = $this->controllerBase->tamponView($userBatiment,['batPlanete'=>$batPlanete]);

            $this->controllerBase->afficheView([$userBatiment],'userGestionBatiment');
        }
    }

}