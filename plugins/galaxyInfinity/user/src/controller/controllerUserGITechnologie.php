<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGITechnologie;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGITechnologie{

    private $managerUserGITechnologie;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGITechnologie = new ManagerUserGITechnologie();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * afficheTechnologieUser
     *
     * Affiche les technologies par rapport au tier sélectionner
     * 
     * @param  int $tier
     * @return void
     */
    public function afficheTechnologieUser($tier){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGITechnologie->idPlanete = $_SESSION['idPlaneteActif'];
            $this->managerUserGITechnologie->tier = $tier;

            $technoBase = $this->managerUserGITechnologie->getTechnoBase();

            $getTechnoEnCours = $this->managerUserGITechnologie->getConstruTechnoEnCours();

            $tempsDecompte = $this->conversionSeconde($getTechnoEnCours['fin_technologie_actuel'] -time());
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
                
                $tempsConstru = $this->managerUserGITechnologie->getTempsConstruTechno();
                $tempsConstru = $this->conversionSeconde($tempsConstru['temps_construction']);
                $technologie[] = ['technoCraft'=>$technoCraft,'tempsConstru'=>$tempsConstru,'verifTechnoEnCours'=>$verifTechnoEnCours,'idTechno' => $technoBase['id'], 'nomTechno' => $technoBase['nom'], 'descrTechno' => $technoBase['description'], 'tierTechno' => $technoBase['tier'],'imageTechno' =>$technoBase['image'], 'prValide' => $verifPrTechno, 'craftValide'=>$verifCraftTechno, 'niveauTechnoPlanete' => $technoBase['niveau']];

            }

            $userTechnologie = '../plugins/galaxyInfinity/user/src/view/userGestionTechnologieView.php';
            $userTechnologie = $this->controllerBase->tamponView($userTechnologie,['technologie' => $technologie, 'tempsRestantTechno'=>$tempsRestantTechno]);

            $this->controllerBase->afficheView([$userTechnologie],'userGestionTechnologie');
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
        
    /**
     * getConstruTechnoJs
     *
     * Récupère la technologie en cours de construction pour le js
     * 
     * @return void
     */
    public function getConstruTechnoJs(){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGITechnologie->idPlanete = $_SESSION['idPlaneteActif'];
            $getTechnoEnCours = $this->managerUserGITechnologie->getConstruTechnoEnCours();
            
            $construEnCours [] = ['idTechno' => $getTechnoEnCours['technologie_id'], 'nomTechno' =>html_entity_decode($getTechnoEnCours['nom']), 'niveauTechno' => $getTechnoEnCours['niveau_technologie_construction'], 'finTechnoActuel' => $getTechnoEnCours['fin_technologie_actuel']];
            
            echo json_encode($construEnCours);
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
    
    /**
     * addConstructionTechno
     *
     * Ajoute la technologie dans la chaine de construction
     * 
     * @param  int $idTechno
     * @return void
     */
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
                else{
                    header('Location:index.php?galaxyInfinity=afficheTechnologieUser&tier=1');
                }
                $tempsConstruTechno = $this->managerUserGITechnologie->getTempsConstruTechno();
                $this->managerUserGITechnologie->finConstruActuel = time() + $tempsConstruTechno['temps_construction'];
                $confirmAdd = $this->managerUserGITechnologie->addConstructionTechno();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheTechnologieUser&tier=1');
                }
            }else{
                header('Location:index.php?galaxyInfinity=afficheTechnologieUser&tier=1');
            }
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }


    
    /**
     * verifPrTechno
     * 
     * Vérifie les pré-requis de la technologie
     *
     * @param  array $technoPR
     * @return void
     */
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
    
    /**
     * verifCraftTechno
     *
     * Vérifie les crafts pour la technologie
     * 
     * @param  array $technoCraft
     * @return void
     */
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
    
    /**
     * conversionSeconde
     *
     * Converti les seocndes en heures minutes et secondes
     * 
     * @param  int $seconde
     * @return void
     */
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