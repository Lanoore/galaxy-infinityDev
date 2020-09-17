<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIHome;

use App\config\themes\controller\controllerBase;


class ControllerUserGIHome{

    private $managerUserGIHome;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIHome = new managerUserGIHome();

        $this->controllerBase = new ControllerBase();


    }


    public function afficheHomeUser(){
        if(isset($_SESSION['pseudo'])){

            $this->managerUserGIHome->idPlanete = $_SESSION['idPlaneteActif'];

            $construCraftEnCours = $this->managerUserGIHome->getConstruCraftEnCours();
            $tempsDecompteCraft = $this->conversionSeconde($construCraftEnCours['fin_craft_actuel']-time());
            $tempsRestantCraft = ['nomCraft' =>$construCraftEnCours['nom'], 'nombreCraft' =>$construCraftEnCours['nombre_craft_total'], 'tempsDecompteCraft' => $tempsDecompteCraft];
            
            $construBatEnCours = $this->managerUserGIHome->getConstruBatEnCours();
            $tempsDecompteBat = $this->conversionSeconde($construBatEnCours['fin_batiment_actuel']-time());
            $tempsRestantBat = ['nomBat' =>$construBatEnCours['nom'], 'niveauBat' =>$construBatEnCours['niveau_batiment_construction'], 'tempsDecompteBat' => $tempsDecompteBat];

            $construTechnoEnCours = $this->managerUserGIHome->getConstruTechnoEnCours();
            $tempsDecompteTechno = $this->conversionSeconde($construTechnoEnCours['fin_technologie_actuel']-time());
            $tempsRestantTechno = ['nomTechno' =>$construTechnoEnCours['nom'], 'niveauTechno' =>$construTechnoEnCours['niveau_technologie_construction'], 'tempsDecompteTechno' => $tempsDecompteTechno];

            

            $allRessources = $this->managerUserGIHome->getAllRessources();

            //get les batiments
            $allBat = $this->managerUserGIHome->getAllBatPlaneteX();
            //get les crafts
            $allCraft = $this->managerUserGIHome->getAllCraftPlaneteX();
            //get les techno
            $allTechno = $this->managerUserGIHome->getAllTechnoPlaneteX();


            $userHome = '../plugins/galaxyInfinity/user/src/view/userGestionHomeView.php';
            $userHome = $this->controllerBase->tamponView($userHome,['allTechno'=>$allTechno,'allCraft'=>$allCraft,'allBat'=>$allBat,'allRessources'=>$allRessources,'tempsRestantCraft'=>$tempsRestantCraft,'tempsRestantBat'=>$tempsRestantBat,'tempsRestantTechno'=>$tempsRestantTechno]);

            $this->controllerBase->afficheView([$userHome],'userGestionHome');
        }
    }


    public function allRessources(){
        if(isset($_SESSION['pseudo'])){

        $this->managerUserGIHome->idPlanete = $_SESSION['idPlaneteActif'];
        $allRessources = $this->managerUserGIHome->getAllRessources();


        foreach($allRessources as $ressource){
            $ressources [] = ['idRessource' => $ressource['ressource_id'], 'nomRessource' => $ressource['nom'],'nombreRessource' =>$ressource['nombre_ressource']];
        }
        
        echo json_encode($ressources);

        }
    }
  


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