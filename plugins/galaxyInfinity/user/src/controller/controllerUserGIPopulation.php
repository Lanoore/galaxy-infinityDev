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

            $popBase = $this->ManagerUserGIPopulation->getPopBase();


            $getPopFormEnCours = $this->ManagerUserGIPopulation->getPopFormEnCours();
            if(!empty($getPopFormEnCours)){
                $tempsDecompte = $this->conversionSeconde($getPopFormEnCours['fin_pop_actuel']-time());
                $tempsRestantForm = ['nomPop' =>$getPopFormEnCours['nom'], 'nombrePopForm' =>$getPopFormEnCours['nombre_pop_formation'], 'tempsDecompte' => $tempsDecompte];
            }
            else{
                $tempsRestantForm = null;
            }

            foreach($popBase as $popBase){

                $countPr = 0;
                $countPop = 0;
                $this->ManagerUserGIPopulation->idPop = $popBase['id'];
                $popForm = $this->ManagerUserGIPopulation->getPopFormX();
                $popPr = $this->ManagerUserGIPopulation->getPrPopX();
                $nombrePop = $this->ManagerUserGIPopulation->getNombrePopX();


                $verifPrPop = $this->verifPrPop($popPr);
                $verifFormPop = $this->verifFormPop($popForm, 1);
                $verifPopEnCours = $this->ManagerUserGIPopulation->verifPopEnCours();

                $populations[] = ['popForm'=>$popForm,'verifPopEnCours'=>$verifPopEnCours,'idPop' => $popBase['id'], 'nomPop' => $popBase['nom'], 'descrPop' => $popBase['description'], 'tierPop' => $popBase['tier'], 'typeUnite' =>$popBase['typeUnite'],'imagePop' =>$popBase['image'],'tempsForm' => $popBase['temps_form'], 'prValide' => $verifPrPop,'nombre_pop' => $nombrePop['nombre_pop'], 'verifFormPop'=>$verifFormPop,];
            }


            $userPopulation = 'plugins/galaxyInfinity/user/src/view/userGestionPopulationView.php';
            $userPopulation = $this->controllerBase->tamponView($userPopulation,['populations' => $populations,  'tempsRestantForm' => $tempsRestantForm]);

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


    public function verifFormPop($popForm, $nombre){
        $countPop = 0;
        foreach ($popForm as $popForm) {
            if(!empty($popForm['craft_id'])){
                $this->ManagerUserGIPopulation->idCraft = $popForm['craft_id'];
                $craftPlanete = $this->ManagerUserGIPopulation->getCraftPlaneteX();
                if($popForm['nombre_craft'] *$nombre  > $craftPlanete['nombre_craft']){
                    $countPop++;
                }
            }
            if(!empty($popForm['pop_id_formation'])){
                $this->ManagerUserGIPopulation->idPopForm = $popForm['pop_id_formation'];
                $populationPlanete = $this->ManagerUserGIPopulation->getPopulationPlaneteX();
                if($popForm['nombre_pop_formation '] *$nombre > $populationPlanete['nombre_pop']){
                    $countPop++;
                }
            }
        }
        return $countPop;
    }


    public function addProdPopulation($idPop){
        if(isset($_SESSION['pseudo'])){
            $this->ManagerUserGIPopulation->idPop = $idPop;
            $getPop = $this->ManagerUserGIPopulation->getPop();
            $verifExist = $this->ManagerUserGIPopulation->verifPopExist();

            if($verifExist == 1){
                $this->ManagerUserGIPopulation->idPlanete = $_SESSION['idPlaneteActif'];
                $popForm = $this->ManagerUserGIPopulation->getpopFormX();
                $popPr = $this->ManagerUserGIPopulation->getPrPopX();
                $verifPrPop = $this->verifPrPop($popPr);
                $verifPopForm = $this->verifFormPop($popForm, $_POST['nombreForm']);
                $verifPopEnCours = $this->ManagerUserGIPopulation->verifPopEnCours();
                if($verifPopForm == 0 && $verifPrPop == 0 && $verifPopEnCours == 0){

                    foreach($popForm as $popForm){
                        if(!empty($popForm['craft_id'])){
                            $this->ManagerUserGIPopulation->idPop = $popForm['craft_id'];
                            $craftPlanete = $this->ManagerUserGIPopulation->getCraftPlaneteX();
                            $this->ManagerUserGIPopulation->nbCraftFinal = $craftPlanete['nombre_craft'] - ($popForm['nombre_craft'] * $_POST['nombreForm']); 
                            $this->ManagerUserGIPopulation->updateCraftXPlaneteX();
                        }
                        if(!empty($popForm['pop_id_formation'])){
                            $this->ManagerUserGIPopulation->idPopForm = $popForm['pop_id_formation'];
                            $ressourcePlanete = $this->ManagerUserGIPopulation->getPopPlaneteX();
                            $this->ManagerUserGIPopulation->nbPopFinal = $ressourcePlanete['nombre_pop'] - ($popForm['nombre_pop_formation'] * $_POST['nombreForm']);
                            $this->ManagerUserGIPopulation->updatePopXPlaneteX(); 

                        }
                    }

                    if($getPop['nom'] == 'Civil'){$multiplicateur = 5;}else{$multiplicateur = 0;}

                    $this->ManagerUserGIPopulation->nombrePop = $_POST['nombreForm'] * $multiplicateur;
                    $this->ManagerUserGIPopulation->finPopActuel = time() + (($_POST['nombreForm'] * $multiplicateur) * $getPop['temps_form']);
                    $confirmAdd = $this->ManagerUserGIPopulation->addFormationPop();
                    
                    if($confirmAdd){
                        header('Location:index.php?galaxyInfinity=affichePopulationUser');
                    }
                }else{
                    header('Location:index.php?galaxyInfinity=affichePopulationUser');
                }
                

            }
            else{
                header('Location:index.php?galaxyInfinity=affichePopulationUser');
            }
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }


        /**
     * conversionSeconde
     *
     * Converti les secondes en heure minute et seconde
     * 
     * @param  int $seconde
     * @return void
     */
    function conversionSeconde($seconde){
        $heures = 0;

        if($seconde < 3600){ 

          
          if($seconde < 60){$minutes = 0;} 
          else{$minutes = round($seconde / 60);} 
          
          $secondes = floor($seconde % 60); 
          } 
          else{ 
          $heures = round($seconde / 3600); 
          $secondes = round($seconde % 3600); 
          $minutes = floor($secondes / 60); 
          } 
          
          $secondes2 = round($secondes % 60); 
        
          $TimeFinal = '';
          if($heures){
              $TimeFinal .= $heures.'h ';
          }
          if($minutes){
              $TimeFinal .= $minutes.'m ';
          }
          if($secondes2){
            $TimeFinal .= $secondes2.'s ';
          }

          return $TimeFinal; 
       }



       public function getFormationPopJs(){
        if(isset($_SESSION['pseudo'])){

            $this->ManagerUserGIPopulation->idPlanete = $_SESSION['idPlaneteActif'];
            $getFormationEnCours = $this->ManagerUserGIPopulation->getPopFormEnCours();

            $formationEnCours [] = ['idPop' => $getFormationEnCours['population_id'],'nomPop' => html_entity_decode($getFormationEnCours['nom']), 'nombrePopForm' => $getFormationEnCours['nombre_pop_formation'],'finFormActuel' => $getFormationEnCours['fin_pop_actuel']];

            echo json_encode($formationEnCours);
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }

}