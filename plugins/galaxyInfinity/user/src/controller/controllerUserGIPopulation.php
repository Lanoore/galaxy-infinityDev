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
            $this->ManagerUserGIPopulation->idPlanete = $_SESSION['idPlaneteActif'];
            //$populations = $this->ManagerUserGIPopulation->getPopulationsPlaneteX();

            $popBase = $this->ManagerUserGIPopulation->getPopBase();

            foreach($popBase as $popBase){
                $this->ManagerUserGIPopulation->idPop = $popBase['id'];
                $popPr = $this->ManagerUserGIPopulation->getPrPopX();
                $nombrePop = $this->ManagerUserGIPopulation->getNombrePopX();

                $verifPrPop = $this->verifPrPop($popPr);
                /*$verifPopEnCours = $this->ManagerUserGIPopulation->verifPopEnCours();

                $tempsFormer = $this->ManagerUserGIPopulation->getTempsFormerPop();
                $tempsFormer = $this->conversionSeconde($tempsFormer['temps_formation']);*/
                $populations[] = [/*'tempsFormer' =>$tempsFormer,'popCraft'=>$popCraft,/*'verifPopEnCours'=>$verifPopEnCours,*/'idPop' => $popBase['id'], 'nomPop' => $popBase['nom'], 'descrPop' => $popBase['description'], 'tierPop' => $popBase['tier'], 'typeUnite' =>$popBase['typeUnite'],'imagePop' =>$popBase['image'], 'prValide' => $verifPrPop,'nombre_pop' => $nombrePop['nombre_pop'], /*'craftValide'=>$verifCraftBat,*/];
            }


            $userPopulation = 'plugins/galaxyInfinity/user/src/view/userGestionPopulationView.php';
            $userPopulation = $this->controllerBase->tamponView($userPopulation,['populations' => $populations]);

            $this->controllerBase->afficheView([$userPopulation],'userGestionPopulation');
        }

    }

    public function verifPrPop($popPr){
        $countPr = 0;

        foreach ($popPr as $popPr) {
            if(!empty($popPr['batiment_id_requis'])){
                $this->ManagerUserGIPopulation->idBatRequis = $popPr['batiment_id_requis'];
                $batPlanete = $this->ManagerUserGIPopulation->getBatPlaneteX();
                if($popPr['niveau_id_batiment'] > $batPlanete['niveau']){
                    $countPr++;
                }
            }
            if(!empty($popPr['technologie_id_requis'])){
                $this->ManagerUserGIPopulation->idTechnoRequis = $popPr['technologie_id_requis'];
                $technoPlanete = $this->ManagerUserGIPopulation->getTechnoPlaneteX();
                if($popPr['niveau_id_technologie'] > $technoPlanete['niveau']){
                    $countPr++;
                }
            }
        }
        return $countPr;
    }

}