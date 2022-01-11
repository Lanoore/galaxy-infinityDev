<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIHome;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGIHome{

    private $managerUserGIHome;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIHome = new managerUserGIHome();

        $this->controllerBase = new ControllerBase();


    }

    
    /**
     * afficheHomeUser
     *
     * Affiche la page général du jeu
     * 
     * @return void
     */
    public function afficheHomeUser(int $tierSelect){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGIHome->idPlanete = $_SESSION['idPlaneteActif'];

            $construCraftEnCours = $this->managerUserGIHome->getConstruCraftEnCours();
            if(!empty($construCraftEnCours)){
                $tempsDecompteCraft = $this->conversionSeconde($construCraftEnCours['fin_craft_actuel']-time());
                $tempsRestantCraft = ['nomCraft' =>$construCraftEnCours['nom'], 'nombreCraft' =>$construCraftEnCours['nombre_craft_total'], 'tempsDecompteCraft' => $tempsDecompteCraft];
            }
            else{
                $tempsRestantCraft = null;
            } 
            
            $construBatEnCours = $this->managerUserGIHome->getConstruBatEnCours();
            if(!empty($construBatEnCours)){
                $tempsDecompteBat = $this->conversionSeconde($construBatEnCours['fin_batiment_actuel']-time());
                $tempsRestantBat = ['nomBat' =>$construBatEnCours['nom'], 'niveauBat' =>$construBatEnCours['niveau_batiment_construction'], 'tempsDecompteBat' => $tempsDecompteBat];
            } 
            else{
                $tempsRestantBat = null;
            } 

            $construTechnoEnCours = $this->managerUserGIHome->getConstruTechnoEnCours();
            if(!empty($construTechnoEnCours)){
                $tempsDecompteTechno = $this->conversionSeconde($construTechnoEnCours['fin_technologie_actuel']-time());
                $tempsRestantTechno = ['nomTechno' =>$construTechnoEnCours['nom'], 'niveauTechno' =>$construTechnoEnCours['niveau_technologie_construction'], 'tempsDecompteTechno' => $tempsDecompteTechno];
            }
            else{
                $tempsRestantTechno = null;
            } 

            $formationPopEnCours = $this->managerUserGIHome->getFormationPopEnCours();
            if(!empty($formationPopEnCours)){
                $tempsDecompteFormation = $this->conversionSeconde($formationPopEnCours['fin_pop_actuel']-time());
                $tempsRestantFormation = ['nomPop' =>$formationPopEnCours['nom'], 'nombrePopForm' =>$formationPopEnCours['nombre_pop_formation'], 'tempsDecompteFormation' => $tempsDecompteFormation];
            }
            else{
                $tempsRestantFormation = null;
            } 
            

            $this->managerUserGIHome->tierSelect = $tierSelect;

            $allRessources = $this->managerUserGIHome->getAllRessources();
            $allBat = $this->managerUserGIHome->getAllBatPlaneteX();
            $allCraft = $this->managerUserGIHome->getAllCraftPlaneteX();
            $allTechno = $this->managerUserGIHome->getAllTechnoPlaneteX();

            $this->managerUserGIHome->idUser = $_SESSION['idUser'];
            $allPlaneteUser = $this->managerUserGIHome->getAllPlaneteUser();

            $userHome = 'plugins/galaxyInfinity/user/src/view/userGestionHomeView.php';
            $userHome = $this->controllerBase->tamponView($userHome,['allPlaneteUser'=>$allPlaneteUser,'allTechno'=>$allTechno,'allCraft'=>$allCraft,'allBat'=>$allBat,'allRessources'=>$allRessources,'tempsRestantCraft'=>$tempsRestantCraft,'tempsRestantBat'=>$tempsRestantBat,'tempsRestantTechno'=>$tempsRestantTechno, 'tempsRestantFormation' => $tempsRestantFormation]);

            $this->controllerBase->afficheView([$userHome],'userGestionHome');
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }

    
    /**
     * allRessources
     *
     * Récupère les ressources pour le js
     * 
     * @return array
     */
    public function allRessources(int $tierSelect){
        if(isset($_SESSION['pseudo'])){

        $this->managerUserGIHome->idPlanete = $_SESSION['idPlaneteActif'];
        $this->managerUserGIHome->tierSelect = $tierSelect;
        $allRessources = $this->managerUserGIHome->getAllRessources();


        foreach($allRessources as $ressource){
            $ressources [] = ['idRessource' => $ressource['ressource_id'], 'nomRessource' => $ressource['nom'],'nombreRessource' =>$ressource['nombre_ressource']];
        }
        
        echo json_encode($ressources);

        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
  

    
    /**
     * conversionSeconde
     *
     * Converti les secondes en heure minute seconde
     * 
     * @param  int $seconde
     * @return void
     */
    public function conversionSeconde($seconde){



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

       public function changerNomPlanete(int $idPlanete){
        if(isset($_SESSION['pseudo'])){

            $verifPlaneteValide = $this->managerUserGIHome->verifPlaneteValide($idPlanete);
            $verifLenghtNom = strlen($_POST['nouveauNom']);
            if($verifPlaneteValide == 1 && $verifLenghtNom < 20){
                $this->managerUserGIHome->nouveauNom = htmlspecialchars($_POST['nouveauNom']);
                $this->managerUserGIHome->changerNomPlanete($idPlanete);
                header('Location:index.php?galaxyInfinity=afficheHomeUser&tierSelect=1');
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheHomeUser&tierSelect=1');
            }   
        }
       }


}