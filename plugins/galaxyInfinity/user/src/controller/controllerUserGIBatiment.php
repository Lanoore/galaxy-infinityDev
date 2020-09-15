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

            $getBatEnCours = $this->managerUserGIBatiment->getConstruBatEnCours();

            $tempsDecompte = $this->decompteTemps($getBatEnCours['fin_batiment_actuel']);
            $tempsRestantBat = ['nomBat' =>$getBatEnCours['nom'], 'niveauBat' =>$getBatEnCours['niveau_batiment_construction'], 'tempsDecompte' => $tempsDecompte];

            foreach ($batBase as $batBase) {

                $this->managerUserGIBatiment->idBat = $batBase['id'];
                $this->managerUserGIBatiment->idNiveau = $batBase['niveau'] + 1;
                $batPR = $this->managerUserGIBatiment->getPrBatX();
                $batCraft = $this->managerUserGIBatiment->getCraftBatX();


                $verifPrBat = $this->verifPrBat($batPR);
                $verifCraftBat = $this->verifCraftBat($batCraft);
                $verifBatEnCours = $this->managerUserGIBatiment->verifBatEnCours();
                $batiment[] = ['verifBatEnCours'=>$verifBatEnCours,'idBat' => $batBase['id'], 'nomBat' => $batBase['nom'], 'descrBat' => $batBase['description'], 'tierBat' => $batBase['tier'],'imageBat' =>$batBase['image'], 'prValide' => $verifPrBat, 'craftValide'=>$verifCraftBat, 'niveauBatPlanete' => $batBase['niveau']];
            }

            $userBatiment = '../plugins/galaxyInfinity/user/src/view/userGestionBatimentView.php';
            $userBatiment = $this->controllerBase->tamponView($userBatiment,['batiment' => $batiment, 'tempsRestantBat' => $tempsRestantBat]);

            $this->controllerBase->afficheView([$userBatiment],'userGestionBatiment');
        }
    }


    public function getConstruBatJs(){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIBatiment->idPlanete = $_SESSION['idPlaneteActif'];
            $getBatEnCours = $this->managerUserGIBatiment->getConstruBatEnCours();

            $construEnCours [] = ['idBat' => $getBatEnCours['batiment_id'], 'nomBat' =>html_entity_decode($getBatEnCours['nom']), 'niveauBat' => $getBatEnCours['niveau_batiment_construction'], 'finBatActuel' => $getBatEnCours['fin_batiment_actuel']];
            
            echo json_encode($construEnCours);
        }
    }


    public function addConstructionBat($idBat){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIBatiment->idPlanete = $_SESSION['idPlaneteActif'];
            $this->managerUserGIBatiment->idBat = $idBat;
            $getBat = $this->managerUserGIBatiment->getBat();
            $verifExist = $this->managerUserGIBatiment->verifBatExist();
            if($verifExist == 1){
                $this->managerUserGIBatiment->idNiveau = $getBat['niveau'] +1;
                $batPR = $this->managerUserGIBatiment->getPrBatX();
                $batCraft = $this->managerUserGIBatiment->getCraftBatX();
                $verifPrBat = $this->verifPrBat($batPR);
                $verifCraftBat = $this->verifCraftBat($batCraft);
                $verifBatEnCours = $this->managerUserGIBatiment->verifBatEnCours();

                if($verifCraftBat == 0 && $verifPrBat == 0 && $verifBatEnCours == 0){

                    foreach($batCraft as $batCraft){
                        if(!empty($batCraft['craft_id'])){
                            $this->managerUserGIBatiment->idCraft = $batCraft['craft_id'];
                            $craftPlanete = $this->managerUserGIBatiment->getCraftPlaneteX();
                            $this->managerUserGIBatiment->nbCraftFinal = $craftPlanete['nombre_craft'] - $batCraft['nombre_craft'];
                            $this->managerUserGIBatiment->updateCraftXPlaneteX();
                        }
                        if(!empty($batCraft['items_id'])){
                            $this->managerUserGIBatiment->idItems = $batCraft['items_id'];
                            $itemsPlanete = $this->managerUserGIBatiment->getItemsPlaneteX();
                            $this->managerUserGIBatiment->nbItemsFinal = $itemsPlanete['nombre_items'] - $batCraft['nombre_items'];
                            $this->managerUserGIBatiment->updateItemsXPlaneteX();
                        }
                    }

                }
                $tempsConstruBat = $this->managerUserGIBatiment->getTempsConstruBat();
                $this->managerUserGIBatiment->finConstruActuel = time() + $tempsConstruBat['temps_construction'];
                $confirmAdd = $this->managerUserGIBatiment->addConstructionBat();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheBatimentUser&tier=1');
                }
            }
        }
    }



    public function verifPrBat($batPr){
        $countPr = 0;
        foreach ($batPr as $batPr) {
            if(!empty($batPr['batiment_id_requis'])){
                $this->managerUserGIBatiment->idBatRequis = $batPr['batiment_id_requis'];
                $batPlanete = $this->managerUserGIBatiment->getBatPlaneteX();
                if($batPr['niveau_id_batiment'] > $batPlanete['niveau']){
                    $countPr++;
                }
            }
            if(!empty($batPr['technologie_id_requis'])){
                $this->managerUserGIBatiment->idTechnoRequis = $batPr['technologie_id_requis'];
                $technoPlanete = $this->managerUserGIBatiment->getTechnoPlaneteX();
                if($batPr['niveau_id_technologie'] > $technoPlanete['niveau']){
                    $countPr++;
                }
            }
        }
        return $countPr;
    }


    public function verifCraftBat($batCraft){
        $countCraft = 0;
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
        return $countCraft;
    }



    function decompteTemps($seconde){

        $seconde = $seconde - time(); 

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
         
          $TimeFinal = "$heures h $minutes min $secondes2 s"; 

          return $TimeFinal; 
       }

}