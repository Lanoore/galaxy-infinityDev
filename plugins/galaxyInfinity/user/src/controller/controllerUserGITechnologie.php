<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGITechnologie;

use App\config\themes\controller\controllerBase;


class ControllerUserGITechnologie{

    private $managerUserGITechnologie;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGITechnologie = new ManagerUserGITechnologie();

        $this->controllerBase = new ControllerBase();
    }

    public function afficheTechnologieUser($tier){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGITechnologie->idPlanete = $_SESSION['idPlaneteActif'];
            $this->managerUserGITechnologie->tier = $tier;

            $technoBase = $this->managerUserGITechnologie->getTechnoBase();

            $technoBaseCraft = $this->managerUserGITechnologie->getTechnoBaseCraft();
            
            foreach ($technoBase as $technoBase) {
                $countPr = 0;
                $countCraft = 0;
                $this->managerUserGITechnologie->idTechno = $technoBase['id'];
                $this->managerUserGITechnologie->idNiveau = $technoBase['niveau'] + 1;
                $technoPR = $this->managerUserGITechnologie->getPrTechnoX();
                $technoCraft = $this->managerUserGITechnologie->getCraftTechnoX();

                foreach ($technoPR as $technoPR) {
                    if(!empty($technoPR['batiment_id_requis'])){
                        $this->managerUserGITechnologie->idBatRequis = $technoPR['batiment_id_requis'];
                        $technoPlanete = $this->managerUserGITechnologie->getBatPlaneteX();
                        if($technoPR['niveau_id_batiment'] > $technoPlanete['niveau']){
                            $countPr++;
                        }
                    }
                    if(!empty($technoPR['technologie_id_requis'])){
                        $this->managerUserGITechnologie->idTechnoRequis = $technoPR['technologie_id_requis'];
                        $technoPlanete = $this->managerUserGITechnologie->getTechnoPlaneteX();
                        if($technoPR['niveau_id_technologie'] > $technoPlanete['niveau']){
                            $countPr++;
                        }
                    }
                }
                foreach ($technoCraft as $technoCraft) {
                    if(!empty($technoCraft['craft_id'])){
                        $this->managerUserGITechnologie->idCraft = $technoCraft['craft_id'];
                        $craftPlanete = $this->managerUserGITechnologie->getCraftPlaneteX();
                        if($technoCraft['nombre_craft'] > $craftPlanete['nombre_craft']){
                            $countCraft++;
                        }
                    }
                    if(!empty($technoCraft['items_id'])){
                        $this->managerUserGITechnologie->idItems = $technoCraft['items_id'];
                        $itemsPlanete = $this->managerUserGITechnologie->getItemsPlaneteX();
                        if($technoCraft['nombre_items'] > $itemsPlanete['nombre_items']){
                            $countCraft++;
                        }
                    }
                }
                if($countPr == 0){$prValide = true;}else{$prValide = false;}
                if($countCraft == 0){$craftValide = true;}else{$craftValide = false;}
                $technologie[] = ['idTechno' => $technoBase['id'], 'nomTechno' => $technoBase['nom'], 'descrTechno' => $technoBase['description'], 'tierTechno' => $technoBase['tier'],'imageTechno' =>$technoBase['image'], 'prValide' => $prValide, 'craftValide'=>$craftValide, 'niveauTechnoPlanete' => $technoBase['niveau']];
            }

            




            $userTechnologie = '../plugins/galaxyInfinity/user/src/view/userGestionTechnologieView.php';
            $userTechnologie = $this->controllerBase->tamponView($userTechnologie,['technologie' => $technologie, 'technoBaseCraft' => $technoBaseCraft]);

            $this->controllerBase->afficheView([$userTechnologie],'userGestionTechnologie');
        }
    }
    






}