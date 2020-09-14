<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIPlanete;

use App\config\themes\controller\controllerBase;


class ControllerUserGIPlanete{

    private $managerUserGIPlanete;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIPlanete = new managerUserGIPlanete();

        $this->controllerBase = new ControllerBase();


        $this->gestionPlaneteChangePage();
        
    }

    public function gestionPlaneteChangePage(){
        if(isset($_SESSION['idUser']) && isset($_SESSION['idPlaneteActif'])){

            $this->managerUserGIPlanete->idPlanete = $_SESSION['idPlaneteActif'];

            $this->managerUserGIPlanete->getPlanete();


            //Ajouter gestion prod
            $gestionProd = $this->gestionProdChangePage();

            //Ajouter gestion construction craft
            //Ajouter gestion construction batiment
            //Ajouter gestion construction technologie

            $this->managerUserGIPlanete->lastActivite = time();


            $changeLastActivite = $this->managerUserGIPlanete->changeLastActivitePlanete();

        }
    }

    public function gestionProdChangePage(){
        

        $batimentProd = $this->managerUserGIPlanete->getBatimentProd();

        foreach($batimentProd as $batimentProd){
            $this->managerUserGIPlanete->idBat = $batimentProd['batiment_id'];
            $batPlanete = $this->managerUserGIPlanete->getNiveauBatiment();
            $this->managerUserGIPlanete->niveauBat = $batPlanete['niveau'];
            $prodRessource = $this->managerUserGIPlanete->getProdRessource();
            $this->managerUserGIPlanete->idRessource = $prodRessource['ressource_id'];
            $ressourcePlanete = $this->managerUserGIPlanete->getRessourcePlanete();




            $this->managerUserGIPlanete->totalRessource = $ressourcePlanete['nombre_ressource'] + ($prodRessource['prod_ressource_niveau'] * (time() - $this->managerUserGIPlanete->lastActivite));

            //$differenceTemps = time() - $this->managerUserGIPlanete->lastActivite;

            //$prodTempsEcoule =  $prodRessource['prod_ressource_niveau'] * $differenceTemps;            

            //$this->managerUserGIPlanete->totalRessource = $ressourcePlanete['nombre_ressource'] + $prodTempsEcoule;

            $this->managerUserGIPlanete->changeNombreRessource();
        }

        

        
    }

}