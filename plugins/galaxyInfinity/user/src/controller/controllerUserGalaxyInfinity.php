<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGalaxyInfinity;

use App\config\themes\controller\controllerBase;


class ControllerUserGalaxyInfinity{

    private $managerUserGI;

    private $controllerBase;

    public function __construct(){
        $this->managerUserGI = new ManagerUserGalaxyInfinity();

        $this->controllerBase = new ControllerBase();
    }

    public function createUserGI(){
        $this->managerUserGI->pseudo = $this->pseudo;
        $this->managerUserGI->getUserByPseudo();
        
        $planetes = $this->managerUserGI->getPlanetesDispo();
        $nPlanete = array_rand($planetes,1);
        $this->managerUserGI->idPlanete = $planetes[$nPlanete]['id'];

        $confirmAdd = $this->managerUserGI->attributPlaneteUser();
        if($confirmAdd){

            $batBase = $this->managerUserGI->getBatBaseUser(); 
            $technoBase = $this->managerUserGI->getTechnoBaseUser();
            $craftBase = $this->managerUserGI->getCraftBaseUser();
            $itemsBase = $this->managerUserGI->getItemsBaseUser();

            foreach($batBase as $batBase){
                $this->managerUserGI->idBat = $batBase['id'];
                $this->managerUserGI->setBatBaseUser();
            }

            foreach($technoBase as $technoBase){
                $this->managerUserGI->idTechno = $technoBase['id'];
                $this->managerUserGI->setTechnoBaseUser();
            }

            foreach($craftBase as $craftBase){
                $this->managerUserGI->idCraft = $craftBase['id'];
                $this->managerUserGI->setCraftBaseUser();
            }
            
            foreach($itemsBase as $itemsBase){
                $this->managerUserGI->idItems = $itemsBase['id'];
                $this->managerUserGI->setItemsBaseUser();
            }

            $batStart = $this->managerUserGI->getBatStartPlaneteUser();

            foreach($batStart as $batStart){
                $this->managerUserGI->idBat = $batStart['batiment_id'];
                $this->managerUserGI->niveau = $batStart['niveau_start_id'];
                $this->managerUserGI->setBatStartPlaneteUser();
            }

        }


        //Ajouter mine fer de niveau 1

    }

}