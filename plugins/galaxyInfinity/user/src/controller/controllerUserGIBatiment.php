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

            $batBase = $this->managerUserGIBatiment->getBatBase();

            $batBaseCraft = $this->managerUserGIBatiment->getBatBaseCraft();
            
            foreach ($batBase as $batBase) {
                $countPr = 0;
                $countCraft = 0;
                $this->managerUserGIBatiment->idBat = $batBase['id'];
                $this->managerUserGIBatiment->idNiveau = $batBase['niveau'] + 1;
                $batPR = $this->managerUserGIBatiment->getPrBatX();
                $batCraft = $this->managerUserGIBatiment->getCraftBatX();

                foreach ($batPR as $batPR) {
                    if(!empty($batPR['batiment_id_requis'])){
                        $this->managerUserGIBatiment->idBatRequis = $batPR['batiment_id_requis'];
                        $batPlanete = $this->managerUserGIBatiment->getBatPlaneteX();
                        if($batPR['niveau_id_batiment'] > $batPlanete['niveau']){
                            $countPr++;
                        }
                    }
                    if(!empty($batPR['technologie_id_requis'])){
                        $this->managerUserGIBatiment->idTechnoRequis = $batPR['technologie_id_requis'];
                        $technoPlanete = $this->managerUserGIBatiment->getTechnoPlaneteX();
                        if($batPR['niveau_id_technologie'] > $technoPlanete['niveau']){
                            $countPr++;
                        }
                    }
                }
                foreach ($batCraft as $batCraft) {
                    if(!empty($batCraft['craft_id'])){
                        $this->managerUserGIBatiment->idCraft = $batCraft['craft_id'];
                        $craftPlanete = $this->managerUserGIBatiment->getCraftPlaneteX();
                        if($batCraft['nombre_craft'] > $craftPlanete['nombre_craft']){
                            $countCraft++;
                        }
                    }
                    if(!empty($batCraft['items_id'])){
                        $this->managerUserGIBatiment->idItems = $batCraft['items_id'];
                        $itemsPlanete = $this->managerUserGIBatiment->getItemsPlaneteX();
                        if($batCraft['nombre_items'] > $itemsPlanete['nombre_items']){
                            $countCraft++;
                        }
                    }
                }
                if($countPr == 0){$prValide = true;}else{$prValide = false;}
                if($countCraft == 0){$craftValide = true;}else{$craftValide = false;}
                $batiment[] = ['idBat' => $batBase['id'], 'nomBat' => $batBase['nom'], 'descrBat' => $batBase['description'], 'tierBat' => $batBase['tier'],'imageBat' =>$batBase['image'], 'prValide' => $prValide, 'craftValide'=>$craftValide, 'niveauBatPlanete' => $batBase['niveau']];
            }

            




            $userBatiment = '../plugins/galaxyInfinity/user/src/view/userGestionBatimentView.php';
            $userBatiment = $this->controllerBase->tamponView($userBatiment,['batiment' => $batiment, 'batBaseCraft' => $batBaseCraft]);

            $this->controllerBase->afficheView([$userBatiment],'userGestionBatiment');
        }
    }

}