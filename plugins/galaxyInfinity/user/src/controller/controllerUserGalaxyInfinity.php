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
    
    /**
     * createUserGI
     *
     * Création de l'utilisateur coté galaxy infinity
     * 
     * @return void
     */
    public function createUserGI(){
        $this->managerUserGI->pseudo = $this->pseudo;
        $this->managerUserGI->getUserByPseudo();
        
        $planetes = $this->managerUserGI->getPlanetesDispo();
        $nPlanete = array_rand($planetes,1);
        $this->managerUserGI->idPlanete = $planetes[$nPlanete]['id'];
        $this->managerUserGI->lastActivite = time();

        $confirmAdd = $this->managerUserGI->attributPlaneteUser();
        if($confirmAdd){

            $batBase = $this->managerUserGI->getBatBaseUser(); 
            $technoBase = $this->managerUserGI->getTechnoBaseUser();
            $craftBase = $this->managerUserGI->getCraftBaseUser();
            $itemsBase = $this->managerUserGI->getItemsBaseUser();
            $ressourceBase = $this->managerUserGI->getRessourceBaseUser();

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

            foreach ($ressourceBase as $ressourceBase) {
                $this->managerUserGI->idRessource = $ressourceBase['id'];
                $this->managerUserGI->setRessourceBaseUser();
            }

            $batStart = $this->managerUserGI->getBatStartPlaneteUser();

            foreach($batStart as $batStart){
                $this->managerUserGI->idBat = $batStart['batiment_id'];
                $this->managerUserGI->niveau = $batStart['niveau_start_id'];
                $this->managerUserGI->setBatStartPlaneteUser();
            }

            
        }
    }

    public function gestionUserConnectionGI(){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGI->idUser = $_SESSION['idUser'];

            $infoUserPlanete = $this->managerUserGI->getPlaneteUser();
            $_SESSION['idPlaneteActif'] = $infoUserPlanete['id'];
            
        }
    }

    
    public function affichePreRequisUser($page){
        if(isset($_SESSION['pseudo'])){
        
            if($page == 'batiment'){$this->managerUserGI->pRTable = 'pre_requis_batiment';$this->managerUserGI->pRBaseTable = 'batiment';$this->managerUserGI->prX = 'batiment_id';}
            elseif($page == 'technologie'){$this->managerUserGI->pRTable = 'pre_requis_technologie';$this->managerUserGI->pRBaseTable = 'technologie';$this->managerUserGI->prX = 'technologie_id';}
            elseif($page == 'craft'){$this->managerUserGI->pRTable = 'pre_requis_craft';$this->managerUserGI->pRBaseTable = 'craft';$this->managerUserGI->prX = 'craft_id';}
            else{echo('Variable non valide');}
            
            $preRequisBaseX = $this->managerUserGI->preRequisBaseX();
            
            $preRequisX = $this->managerUserGI->getPreRequisX();
            

            $preRequis = '../plugins/galaxyInfinity/user/src/view/preRequisUserView.php';
            $preRequis = $this->controllerBase->tamponView($preRequis,['preRequisBaseX'=>$preRequisBaseX,'preRequisX'=> $preRequisX]);
            $this->controllerBase->afficheView([$preRequis],'preRequisGI');
        }
    }



}