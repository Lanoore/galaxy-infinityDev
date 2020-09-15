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

            $getTechnoEnCours = $this->managerUserGITechnologie->getConstruTechnoEnCours();

            $tempsDecompte = $this->decompteTemps($getTechnoEnCours['fin_technologie_actuel']);
            $tempsRestantTechno = ['nomTechno' =>$getTechnoEnCours['nom'], 'niveauTechno' =>$getTechnoEnCours['niveau_technologie_construction'], 'tempsDecompte' => $tempsDecompte];
            
            foreach ($technoBase as $technoBase) {
                $countPr = 0;
                $countCraft = 0;
                $this->managerUserGITechnologie->idTechno = $technoBase['id'];
                $this->managerUserGITechnologie->idNiveau = $technoBase['niveau'] + 1;
                $technoPR = $this->managerUserGITechnologie->getPrTechnoX();
                $technoCraft = $this->managerUserGITechnologie->getCraftTechnoX();


                $verifPrTechno = $this->verifPrTechno($technoPR);
                $verifCraftTechno = $this->verifCraftTechno($technoCraft);
                $verifTechnoEnCours = $this->managerUserGITechnologie->verifTechnoEncours();
                
                
                $technologie[] = ['verifTechnoEnCours'=>$verifTechnoEnCours,'idTechno' => $technoBase['id'], 'nomTechno' => $technoBase['nom'], 'descrTechno' => $technoBase['description'], 'tierTechno' => $technoBase['tier'],'imageTechno' =>$technoBase['image'], 'prValide' => $verifPrTechno, 'craftValide'=>$verifCraftTechno, 'niveauTechnoPlanete' => $technoBase['niveau']];

            }

            $userTechnologie = '../plugins/galaxyInfinity/user/src/view/userGestionTechnologieView.php';
            $userTechnologie = $this->controllerBase->tamponView($userTechnologie,['technologie' => $technologie, 'tempsRestantTechno'=>$tempsRestantTechno]);

            $this->controllerBase->afficheView([$userTechnologie],'userGestionTechnologie');
        }
    }
    
    public function getConstruTechnoJs(){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGITechnologie->idPlanete = $_SESSION['idPlaneteActif'];
            $getTechnoEnCours = $this->managerUserGITechnologie->getConstruTechnoEnCours();
            
            $construEnCours [] = ['idTechno' => $getTechnoEnCours['technologie_id'], 'nomTechno' =>html_entity_decode($getTechnoEnCours['nom']), 'niveauTechno' => $getTechnoEnCours['niveau_technologie_construction'], 'finTechnoActuel' => $getTechnoEnCours['fin_technologie_actuel']];
            
            echo json_encode($construEnCours);
        }
    }

    public function addConstructionTechno($idTechno){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGITechnologie->idPlanete = $_SESSION['idPlaneteActif'];
            $this->managerUserGITechnologie->idTechno = $idTechno;
            $getTechno = $this->managerUserGITechnologie->getTechno();
            $verifExist = $this->managerUserGITechnologie->verifTechnoExist();
            if($verifExist == 1){
                $this->managerUserGITechnologie->idNiveau = $getTechno['niveau'] +1;
                $technoPR = $this->managerUserGITechnologie->getPrTechnoX();
                $technoCraft = $this->managerUserGITechnologie->getCraftTechnoX();
                $verifPrTechno = $this->verifPrTechno($technoPR);
                $verifCraftTechno = $this->verifCraftTechno($technoCraft);
                $verifTechnoEnCours = $this->managerUserGITechnologie->verifTechnoEnCours();

                if($verifCraftTechno == 0 && $verifPrTechno == 0 && $verifTechnoEnCours == 0){

                    foreach($technoCraft as $technoCraft){
                        if(!empty($technoCraft['craft_id'])){
                            $this->managerUserGITechnologie->idCraft = $technoCraft['craft_id'];
                            $craftPlanete = $this->managerUserGITechnologie->getCraftPlaneteX();
                            $this->managerUserGITechnologie->nbCraftFinal = $craftPlanete['nombre_craft'] - $technoCraft['nombre_craft'];
                            $this->managerUserGITechnologie->updateCraftXPlaneteX();
                        }
                        if(!empty($technoCraft['items_id'])){
                            $this->managerUserGITechnologie->idItems = $technoCraft['items_id'];
                            $itemsPlanete = $this->managerUserGITechnologie->getItemsPlaneteX();
                            $this->managerUserGITechnologie->nbItemsFinal = $itemsPlanete['nombre_items'] - $technoCraft['nombre_items'];
                            $this->managerUserGITechnologie->updateItemsXPlaneteX();
                        }
                    }

                }
                $tempsConstruTechno = $this->managerUserGITechnologie->getTempsConstruTechno();
                $this->managerUserGITechnologie->finConstruActuel = time() + $tempsConstruTechno['temps_construction'];
                $confirmAdd = $this->managerUserGITechnologie->addConstructionTechno();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheTechnologieUser&tier=1');
                }
            }
        }
    }



    public function verifPrTechno($technoPR){
        $countPr = 0;
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
        return $countPr;
    }

    public function verifCraftTechno($technoCraft){
        $countCraft = 0;
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