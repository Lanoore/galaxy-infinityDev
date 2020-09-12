<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGICraft;

use App\config\themes\controller\controllerBase;


class ControllerUserGICraft{

    private $managerUserGICraft;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGICraft = new ManagerUserGICraft();

        $this->controllerBase = new ControllerBase();
    }


    public function afficheCraftUser($tier){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGICraft->idPlanete = $_SESSION['idPlaneteActif'];
            $this->managerUserGICraft->tier = $tier;

            $craftBase = $this->managerUserGICraft->getCraftBase();

            $craftBaseCraft = $this->managerUserGICraft->getCraftBaseCraft();
            
            foreach ($craftBase as $craftBase) {
                $countPr = 0;
                $countCraft = 0;
                $this->managerUserGICraft->idCraft = $craftBase['id'];
                $craftPR = $this->managerUserGICraft->getPrCraftX();
                $craftCraft = $this->managerUserGICraft->getCraftCraftX();
                $nombreCraftPlanete = $this->managerUserGICraft->getCraftPlaneteX();

                foreach ($craftPR as $craftPR) {
                    if(!empty($craftPR['batiment_id_requis'])){
                        $this->managerUserGICraft->idBatRequis = $craftPR['batiment_id_requis'];
                        $batPlanete = $this->managerUserGICraft->getBatPlaneteX();
                        if($craftPR['niveau_id_batiment'] > $batPlanete['niveau']){
                            $countPr++;
                        }
                    }
                    if(!empty($craftPR['technologie_id_requis'])){
                        $this->managerUserGICraft->idTechnoRequis = $craftPR['technologie_id_requis'];
                        $technoPlanete = $this->managerUserGICraft->getTechnoPlaneteX();
                        if($craftPR['niveau_id_technologie'] > $technoPlanete['niveau']){
                            $countPr++;
                        }
                    }
                }
                foreach ($craftCraft as $craftCraft) {
                    if(!empty($craftCraft['craft_id_travail'])){
                        $this->managerUserGICraft->idCraft = $craftCraft['craft_id_travail'];
                        $craftPlanete = $this->managerUserGICraft->getCraftPlaneteX();
                        if($craftCraft['nombre_craft_travail'] > $craftPlanete['nombre_craft']){
                            $countCraft++;
                        }
                    }
                    if(!empty($craftCraft['ressource_id'])){
                        $this->managerUserGICraft->idRessource = $craftCraft['ressource_id'];
                        $ressourcePlanete = $this->managerUserGICraft->getRessourcePlaneteX();
                        if($craftCraft['nombre_ressource'] > $ressourcePlanete['nombre_ressource']){
                            $countCraft++;
                        }
                    }
                }
                if($countPr == 0){$prValide = true;}else{$prValide = false;}
                if($countCraft == 0){$craftValide = true;}else{$craftValide = false;}
                $craft[] = ['idCraft' => $craftBase['id'], 'nomCraft' => $craftBase['nom'], 'descrCraft' => $craftBase['description'], 'tierCraft' => $craftBase['tier'],'imageCraft' =>$craftBase['image'], 'prValide' => $prValide, 'craftValide'=>$craftValide,'nombreCraft' =>$nombreCraftPlanete['nombre_craft']];
            }

            




            $userCraft = '../plugins/galaxyInfinity/user/src/view/userGestionCraftView.php';
            $userCraft = $this->controllerBase->tamponView($userCraft,['craft' => $craft, 'craftBaseCraft' => $craftBaseCraft]);

            $this->controllerBase->afficheView([$userCraft],'userGestionCraft');
        }
    }

}