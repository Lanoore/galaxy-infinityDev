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

            $getCraftEnCours = $this->managerUserGICraft->getConstruCraftEnCours();

            $tempsDecompte = $this->conversionSeconde($getCraftEnCours['fin_craft_actuel']-time());

            $tempsRestantCraft = ['nomCraft' =>$getCraftEnCours['nom'], 'nombreCraft' =>$getCraftEnCours['nombre_craft_total'], 'tempsDecompte' => $tempsDecompte];

            foreach ($craftBase as $craftBase) {
                $countPr = 0;
                $countCraft = 0;
                $this->managerUserGICraft->idCraft = $craftBase['id'];
                $craftPR = $this->managerUserGICraft->getPrCraftX();
                $craftCraft = $this->managerUserGICraft->getCraftCraftX();
                $nombreCraftPlanete = $this->managerUserGICraft->getCraftPlaneteX();
                
                $verifPrCraft = $this->verifPrCraft($craftPR);
                $verifCraftCraft = $this->verifCraftCraft($craftCraft);
                $verifCraftEnCours = $this->managerUserGICraft->verifCraftEnCours();


                $tempsConstru = $this->conversionSeconde($craftBase['temps_base']);
                $craft[] = ['craftCraft'=>$craftCraft,'verifCraftEnCours'=>$verifCraftEnCours,'idCraft' => $craftBase['id'], 'nomCraft' => $craftBase['nom'],'tempsConstru'=>$tempsConstru, 'descrCraft' => $craftBase['description'], 'tierCraft' => $craftBase['tier'],'imageCraft' =>$craftBase['image'], 'verifPrCraft' => $verifPrCraft, 'verifCraftCraft'=>$verifCraftCraft,'nombreCraft' =>$nombreCraftPlanete['nombre_craft']];
            }

            $userCraft = '../plugins/galaxyInfinity/user/src/view/userGestionCraftView.php';
            $userCraft = $this->controllerBase->tamponView($userCraft,['craft' => $craft, 'tempsRestantCraft' => $tempsRestantCraft]);

            $this->controllerBase->afficheView([$userCraft],'userGestionCraft');
        }
    }
    
    public function getConstruCraftJs(){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGICraft->idPlanete = $_SESSION['idPlaneteActif'];
            $getCraftEnCours = $this->managerUserGICraft->getConstruCraftEnCours();

            $craftEnCours [] = ['idCraft' => $getCraftEnCours['craft_id'],'nomCraft' => html_entity_decode($getCraftEnCours['nom']), 'nombreCraft' => $getCraftEnCours['nombre_craft_total'],'finCraftActuel' => $getCraftEnCours['fin_craft_actuel']];

            echo json_encode($craftEnCours);
        }
    }


    public function addConstructionCraft($idCraft){
        
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGICraft->idCraft = $idCraft;
            $getCraft = $this->managerUserGICraft->getCraft();
            $verifExist = $this->managerUserGICraft->verifCraftExist();

            if($verifExist == 1){
                $this->managerUserGICraft->idPlanete = $_SESSION['idPlaneteActif'];
                $craftCraft = $this->managerUserGICraft->getCraftCraftX();
                $craftPR = $this->managerUserGICraft->getPrCraftX();
                $verifPrCraft = $this->verifPrCraft($craftPR);
                $verifCraftCraft = $this->verifCraftCraft($craftCraft, $_POST['nombreCraft']);
                $verifCraftEnCours = $this->managerUserGICraft->verifCraftEnCours();
                if($verifCraftCraft == 0 && $verifPrCraft == 0 && $verifCraftEnCours == 0){

                    foreach($craftCraft as $craftCraft){
                        if(!empty($craftCraft['craft_id_travail'])){
                            $this->managerUserGICraft->idCraft = $craftCraft['craft_id_travail'];
                            $craftPlanete = $this->managerUserGICraft->getCraftPlaneteX();
                            $this->managerUserGICraft->nbCraftFinal = $craftPlanete['nombre_craft_travail'] - ($craftCraft['nombre_craft'] * $_POST['nombreCraft']); 
                            $this->managerUserGICraft->updateCraftXPlaneteX();
                        }
                        if(!empty($craftCraft['ressource_id'])){
                            $this->managerUserGICraft->idRessource = $craftCraft['ressource_id'];
                            $ressourcePlanete = $this->managerUserGICraft->getRessourcePlaneteX();
                            $this->managerUserGICraft->nbRessourceFinal = $ressourcePlanete['nombre_ressource'] - ($craftCraft['nombre_ressource'] * $_POST['nombreCraft']);
                            $this->managerUserGICraft->updateRessourceXPlaneteX(); 

                        }
                    }

                    $this->managerUserGICraft->nombreCraft = $_POST['nombreCraft'];
                    $this->managerUserGICraft->finCraftActuel = time() + ($_POST['nombreCraft'] * $getCraft['temps_base']);
                    $confirmAdd = $this->managerUserGICraft->addConstructionCraft();
                    
                    if($confirmAdd){
                        header('Location:index.php?galaxyInfinity=afficheCraftUser&tier=1');
                    }
                }
                

            }
        }
    }


    public function verifPrCraft($craftPR){
        $countPr = 0;
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
        return $countPr;
    }

    public function verifCraftCraft($craftCraft, $nombre = 1){
        $countCraft = 0;
        foreach ($craftCraft as $craftCraft) {
            if(!empty($craftCraft['craft_id_travail'])){
                $this->managerUserGICraft->idCraft = $craftCraft['craft_id_travail'];
                $craftPlanete = $this->managerUserGICraft->getCraftPlaneteX();
                if($craftCraft['nombre_craft_travail'] *$nombre  > $craftPlanete['nombre_craft']){
                    $countCraft++;
                }
            }
            if(!empty($craftCraft['ressource_id'])){
                $this->managerUserGICraft->idRessource = $craftCraft['ressource_id'];
                $ressourcePlanete = $this->managerUserGICraft->getRessourcePlaneteX();
                if($craftCraft['nombre_ressource'] *$nombre > $ressourcePlanete['nombre_ressource']){
                    $countCraft++;
                }
            }
        }
        return $countCraft;
    }



    function conversionSeconde($seconde){


        if($seconde < 3600){ 
          $heures = 0; 
          
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
              $TimeFinal .= $heures.'h';
          }
          if($minutes){
              $TimeFinal .= $minutes.'m';
          }
          if($secondes2){
            $TimeFinal .= $secondes2.'s';
          }

          return $TimeFinal; 
       }

}