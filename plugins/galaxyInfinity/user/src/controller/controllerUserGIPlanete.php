<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIPlanete;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGIPlanete{

    private $managerUserGIPlanete;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIPlanete = new managerUserGIPlanete();

        $this->controllerBase = new ControllerBase();


        $this->gestionPlaneteChangePage();
        
    }
    
    /**
     * gestionPlaneteChangePage
     *
     * Gère les différentes fonctions au changement de page
     * 
     * @return void
     */
    public function gestionPlaneteChangePage(){
        if(isset($_SESSION['idUser']) && isset($_SESSION['idPlaneteActif'])){

            $this->managerUserGIPlanete->idPlanete = $_SESSION['idPlaneteActif'];

            $this->managerUserGIPlanete->getPlanete();


            $gestionProd = $this->gestionProdChangePage();
            
            $gestionConstructionCraft = $this->gestionConstruCraftChangePage();

            $gestionConstructionBat = $this->gestionConstruBatChangePage();

            $gestionConstructionTechno = $this->gestionConstruTechnoChangePage();

            $gestionFormationPop = $this->gestionFormationPopChangePage();

            $this->managerUserGIPlanete->lastActivite = time();


            $changeLastActivite = $this->managerUserGIPlanete->changeLastActivitePlanete();

        }
    }
    
    /**
     * gestionProdChangePage
     *
     * Gére la mise à jour des ressources au chargement de la page
     * 
     * @return void
     */
    public function gestionProdChangePage(){
        

        $batimentProd = $this->managerUserGIPlanete->getBatimentProd();

        foreach($batimentProd as $batimentProd){
            $this->managerUserGIPlanete->idBat = $batimentProd['batiment_id'];
            $batPlanete = $this->managerUserGIPlanete->getNiveauBatiment();
            $this->managerUserGIPlanete->niveauBat = $batPlanete['niveau'];
            $prodRessource = $this->managerUserGIPlanete->getProdRessource();
            if($prodRessource == true){
                $this->managerUserGIPlanete->idRessource = $prodRessource['ressource_id'];
                $ressourcePlanete = $this->managerUserGIPlanete->getRessourcePlanete();
    
                $this->managerUserGIPlanete->totalRessource = $ressourcePlanete['nombre_ressource'] + ($prodRessource['prod_ressource_niveau'] * (time() - $this->managerUserGIPlanete->lastActivite));
    
                $this->managerUserGIPlanete->changeNombreRessource();
            }

            
        }
    }

    
    /**
     * gestionConstruCraftChangePage
     * 
     * Gére la mise à jour du temps de construction des crafts en cours
     *
     * @return void
     */
    public function gestionConstruCraftChangePage(){
        $construCraftEnCours = $this->managerUserGIPlanete->getConstruCraftEnCours();

        if(!empty($construCraftEnCours)){
            if(time() >= $construCraftEnCours['fin_craft_actuel']){
                $this->managerUserGIPlanete->idCraft = $construCraftEnCours['craft_id'];
                $getNbCraftActuel = $this->managerUserGIPlanete->getNbCraftActuel();
                $this->managerUserGIPlanete->nombreCraftTotal = $getNbCraftActuel['nombre_craft'] + $construCraftEnCours['nombre_craft_total'];
                $this->managerUserGIPlanete->addNombreCraftInPlanete();
                $this->managerUserGIPlanete->supprLigneCraftEnCoursPlanete();
            }
        }
        
    }
    
    /**
     * gestionConstruBatChangePage
     *
     * Gére la mise à jour du temps de construction des batiments en cours
     * 
     * @return void
     */
    public function gestionConstruBatChangePage(){
        $construcBatEnCours = $this->managerUserGIPlanete->getConstruBatEnCours();
        if(!empty($construcBatEnCours)){
            if(time() >= $construcBatEnCours['fin_batiment_actuel']){
                $this->managerUserGIPlanete->idBat = $construcBatEnCours['batiment_id'];
                $this->managerUserGIPlanete->niveauBatFinal = $construcBatEnCours['niveau_batiment_construction'];
                $this->managerUserGIPlanete->modifNiveauBatPlanete();
                $this->managerUserGIPlanete->supprLigneBatEnCoursPlanete();
            }
        }
        
    }
    
    /**
     * gestionConstruTechnoChangePage
     *
     * Gére la mise à jour du temps de construction des technologie en cours
     * 
     * @return void
     */
    public function gestionConstruTechnoChangePage(){
        $construTechnoEnCours = $this->managerUserGIPlanete->getConstruTechnoEnCours();
        if(!empty($construTechnoEnCours)){
            if(time() >= $construTechnoEnCours['fin_technologie_actuel']){
                $this->managerUserGIPlanete->idTechno = $construTechnoEnCours['technologie_id'];
                $this->managerUserGIPlanete->niveauTechnoFinal = $construTechnoEnCours['niveau_technologie_construction'];
                $this->managerUserGIPlanete->modifNiveauTechnoPlanete();
                $this->managerUserGIPlanete->supprLigneTechnoEnCoursPlanete();
            }
        }
    }

    public function gestionFormationPopChangePage(){
        $formationPopEnCours = $this->managerUserGIPlanete->getFormationPopEnCours();
        if(!empty($formationPopEnCours)){
            if(time() >= $formationPopEnCours['fin_pop_actuel']){
                $this->managerUserGIPlanete->idPop = $formationPopEnCours['population_id'];
                $nombrePopFormation = $formationPopEnCours['nombre_pop_formation'];
                $getPopXPlaneteX = $this->managerUserGIPlanete->getPopXPlaneteX();
                $this->managerUserGIPlanete->nombreTotalPopX = $nombrePopFormation + $getPopXPlaneteX['nombre_pop'];
                $this->managerUserGIPlanete->modifNombreTotalPopPlanete();
                $this->managerUserGIPlanete->supprLigneFormPopEnCoursPlanete();
            }
        }
    }

}