<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGIRessource;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGIBatiment;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGalaxyInfinity;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */

use App\config\themes\controller\controllerBase;

class ControllerAdminGICraft{
    /* Mettre ici les variables privates pour les manager */
    private $managerAdminGICraft;
    private $managerAdminGIRessource;
    private $managerAdminGIBatiment;
    private $managerAdminGalaxyInfinity;
    private $managerAdminGITechnologie;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;


    public function __construct(){
        $this->managerAdminGICraft = new managerAdminGICraft();
        $this->managerAdminGIRessource = new ManagerAdminGIRessource();
        $this->managerAdminGalaxyInfinity = new ManagerAdminGalaxyInfinity();
        $this->managerAdminGITechnologie = new ManagerAdminGITechnologie();
        $this->managerAdminGIBatiment = new ManagerAdminGIBatiment();

        $this->controllerBase = new ControllerBase();
    }

    public function adminGestionCraft(){
        if(isset($_SESSION['identifiantAdmin'])){

            $crafts = $this->managerAdminGICraft->getCraftBaseAdmin();
            $craftCrafts = $this->managerAdminGICraft->getCraftCraftAdmin();
            $craftsPR = $this->managerAdminGICraft->getCraftPRAdmin();

            $ressources = $this->managerAdminGIRessource->getRessources();
            $technologies = $this->managerAdminGITechnologie->getTechnologieBaseAdmin();
            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();
            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionCraftView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['craftsPR'=>$craftsPR,'technologies'=>$technologies,'adminBatBase'=>$adminBatBase,'niveaux'=>$niveaux,'craftCrafts' =>$craftCrafts,'ressources' =>$ressources,'crafts' => $crafts]);
            $this->controllerBase->afficheView([$adminGI]);

        }
        else{
            throw new Exception('Varibale de session inconnue');
        }
    }


    public function createCraftBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->nomCraft = htmlentities($_POST['nomCraft']);
            $this->managerAdminGICraft->descrCraft = htmlentities($_POST['descr']);
            $this->managerAdminGICraft->tierCraft = htmlentities($_POST['tier']);
            $this->managerAdminGICraft->tempsCraft = htmlentities($_POST['tempsCraft']);

            $this->managerAdminGICraft->verifCraftExist();

            if($this->managerAdminGICraft->craftExist == 0){
                $insertCraft = $this->managerAdminGICraft->insertCraftBase();
                if($insertCraft){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
                
            }

        }
    }

    public function supprCraftBase($idCraft){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idCraft = $idCraft;
            $supprCraft=$this->managerAdminGICraft->supprCraftBase();
            if($supprCraft){
                header('Location:index?galaxyInfinity=afficheAdminGestionCraft');
            }
            
        }
    }

    public function modifCraftBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idCraft = $_POST['idCraft'];
            $this->managerAdminGICraft->getCraftBaseById();
            
            if(!empty($_POST['nomCraft'])){$this->managerAdminGICraft->nomCraft = htmlentities($_POST['nomCraft']);}
            if(!empty($_POST['descr'])){$this->managerAdminGICraft->descrCraft = htmlentities($_POST['descr']);}
            if(!empty($_POST['tier'])){$this->managerAdminGICraft->tierCraft = htmlentities($_POST['tier']);}
            if(!empty($_POST['tempsCraft'])){$this->managerAdminGICraft->tempsCraft = htmlentities($_POST['tempsCraft']);}
              
            
            $confirmModif = $this->managerAdminGICraft->modifCraftBase();

            if($confirmModif){  
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
            else{
                
            }

        }
    }

    public function createCraftCraft(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idCraft = htmlentities($_POST['idCraft']);
            
            if(!empty($_POST['nombreRessource'])){
                if(!empty($_POST['idRessource'])){$this->managerAdminGICraft->idRessource = htmlentities($_POST['idRessource']);}else{$this->managerAdminGICraft->idRessource = null;}
                $this->managerAdminGICraft->nombreRessource = htmlentities($_POST['nombreRessource']);
            }
            else{
                $this->managerAdminGICraft->idRessource = null;
                $this->managerAdminGICraft->nombreRessource = null;
            }
            
            if(!empty($_POST['nombreCraftTravail'])){
                if(!empty($_POST['craftTravail'])){$this->managerAdminGICraft->craftTravail = htmlentities($_POST['craftTravail']);}else{$this->managerAdminGICraft->craftTravail = null;}
                $this->managerAdminGICraft->nombreCraftTravail = htmlentities($_POST['nombreCraftTravail']);
            }
            else{
                $this->managerAdminGICraft->craftTravail = null;
                $this->managerAdminGICraft->nombreCraftTravail = null;
            }

            $verifExist = $this->managerAdminGICraft->verifCraftCraftExist();
            if($verifExist == 0){
                
                $confirmAdd = $this->managerAdminGICraft->createCraftCraft();
                echo('test');
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }
        }
    }

    public function supprCraftCraft($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idLigne = $idLigne;

            $verifExist = $this->managerAdminGICraft->verifExistCraftCraftById();
            if($verifExist == 1){
                $confirmSuppr = $this->managerAdminGICraft->supprCraftCraft();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }
        }
    }

    public function modifCraftCraft(){
        
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGICraft->idLigne = $_POST['idLigne'];
            $this->managerAdminGICraft->idCraft = $_POST['idCraft'];

            if(!empty($_POST['nombreRessource'])){
                if(!empty($_POST['idRessource'])){$this->managerAdminGICraft->idRessource = htmlentities($_POST['idRessource']);}else{$this->managerAdminGICraft->idRessource = null;}
                $this->managerAdminGICraft->nombreRessource = htmlentities($_POST['nombreRessource']);
            }
            else{
                $this->managerAdminGICraft->idRessource = null;
                $this->managerAdminGICraft->nombreRessource = null;
            }
            
            if(!empty($_POST['nombreCraftTravail'])){
                if(!empty($_POST['craftTravail'])){$this->managerAdminGICraft->craftTravail = htmlentities($_POST['craftTravail']);}else{$this->managerAdminGICraft->craftTravail = null;}
                $this->managerAdminGICraft->nombreCraftTravail = htmlentities($_POST['nombreCraftTravail']);
            }
            else{
                $this->managerAdminGICraft->craftTravail = null;
                $this->managerAdminGICraft->nombreCraftTravail = null;
            }
            
            $verifExist = $this->managerAdminGICraft->verifExistCraftCraftById();
            
            if($verifExist){
                $confirmModif = $this->managerAdminGICraft->modifCraftCraft();
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }
        }
    }


    public function createCraftPR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idCraft = htmlentities($_POST['idCraft']);
            
            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGICraft->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGICraft->idBatPR = null;}
                $this->managerAdminGICraft->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGICraft->idBatPR = null;
                $this->managerAdminGICraft->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGICraft->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGICraft->idTechnoPR = null;}
                $this->managerAdminGICraft->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGICraft->idTechnoPR = null;
                $this->managerAdminGICraft->niveauTechnoPR = null;
            }
            echo('test');
            $verifExist = $this->managerAdminGICraft->verifCraftPRExist();
                
            if($verifExist == 0){
                
                $confirmAdd = $this->managerAdminGICraft->createCraftPR();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }

        }
    }

    public function supprCraftPR($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idLigne = $idLigne;
            
            $verifExist = $this->managerAdminGICraft->verifCraftPRExistById();
            echo('test');
            if($verifExist == 1){
                $confirmSuppr = $this->managerAdminGICraft->supprCraftPR();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }
        }
    }

    public function modifCraftPR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGICraft->idCraft = htmlentities($_POST['idCraft']);

            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGICraft->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGICraft->idBatPR = null;}
                $this->managerAdminGICraft->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGICraft->idBatPR = null;
                $this->managerAdminGICraft->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGICraft->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGICraft->idTechnoPR = null;}
                $this->managerAdminGICraft->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGICraft->idTechnoPR = null;
                $this->managerAdminGICraft->niveauTechnoPR = null;
            }
            
            $verifExist = $this->managerAdminGICraft->verifCraftPRExistById();
            
            if($verifExist == 1){
                $confirmModif = $this->managerAdminGICraft->modifCraftPR();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }
        }
    }

}