<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIRessource;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIBatiment;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGalaxyInfinity;

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
    
    /**
     * adminGestionCraft
     * 
     * Affiche la gestion des crafts coté admin
     *
     * @return void
     */
    public function adminGestionCraft(){
        if(isset($_SESSION['identifiantAdmin'])){

            $crafts = $this->managerAdminGICraft->getCraftBaseAdmin();
            $craftCrafts = $this->managerAdminGICraft->getCraftCraftAdmin();
            $craftsPR = $this->managerAdminGICraft->getCraftPRAdmin();

            $ressources = $this->managerAdminGIRessource->getRessources();
            $technologies = $this->managerAdminGITechnologie->getTechnologieBaseAdmin();
            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();
            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();

            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionCraftView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['craftsPR'=>$craftsPR,'technologies'=>$technologies,'adminBatBase'=>$adminBatBase,'niveaux'=>$niveaux,'craftCrafts' =>$craftCrafts,'ressources' =>$ressources,'crafts' => $crafts]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionCraft');

        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

    
    /**
     * createCraftBase
     * 
     * Créer le craft de base avec son nom,tier,description, temps de base et l'image
     *
     * @return void
     */
    public function createCraftBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->nomCraft = htmlentities($_POST['nomCraft']);
            $this->managerAdminGICraft->descrCraft = htmlentities($_POST['descr']);
            $this->managerAdminGICraft->tierCraft = htmlentities($_POST['tier']);
            $this->managerAdminGICraft->tempsCraft = htmlentities($_POST['tempsCraft']);

            $this->managerAdminGICraft->verifCraftExist();

            if($this->managerAdminGICraft->craftExist == 0){
                if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0){
                    if($_FILES['image']['size']<= 1000000){
                        $infosfichier = pathinfo($_FILES['image']['name']);
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees))
                        {
                            $this->managerAdminGICraft->imageCraft = $_POST['nomCraft'].'.'.$infosfichier['extension'];
                            $insertCraft = $this->managerAdminGICraft->insertCraftBase();
                            if($insertCraft){
                                $nomFichier = $_POST['nomCraft'].'.'.$infosfichier['extension'];
                                move_uploaded_file($_FILES['image']['tmp_name'], 'plugins/galaxyInfinity/admin/public/img/craft/' . basename($nomFichier));
                                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                            }
                        }
                    }
                    else{
                        header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                    }
                 }
                 else{
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                 }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprCraftBase
     * 
     *  Supprime  le craft de base sélectionner
     *
     * @param  int $idCraft
     * @return void
     */
    public function supprCraftBase($idCraft){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGICraft->idCraft = $idCraft;

            $craftExist = $this->managerAdminGICraft->getCraftBaseById();
            if($craftExist == 1){
                if(isset($_POST['Supprimer'])){
                    $supprCraft=$this->managerAdminGICraft->supprCraftBase();
                    if($supprCraft){
                        unlink('/plugins/galaxyInfinity/admin/public/img/craft/'. $this->managerAdminGICraft->imageCraft);
                        header('Location:index?galaxyInfinity=afficheAdminGestionCraft');
                    }
                }
            }
            else{
                header('Location:index?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifCraftBase
     *
     *  Modifie le craft de base sélectionner
     * 
     * @return void
     */
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
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * createCraftCraft
     *
     *  Créer le craft pour le craft avec la ressource et/ou le craft requis ainsi que le nombre associer
     * 
     * @return void
     */
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
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprCraftCraft
     *
     *  Supprime le craft du craft sélectionner
     * 
     * @param  int $idLigne
     * @return void
     */
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
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifCraftCraft
     *
     *  Modifie le craft du craft sélectionner
     * 
     * @return void
     */
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
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

    
    /**
     * createCraftPR
     *
     *  Créer le pré-requis du craft sélectionner avec le niveau du batiment et/ou de la technologie sélectionner
     * 
     * @return void
     */
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

                
                $confirmAdd = $this->managerAdminGICraft->createCraftPR();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
                }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprCraftPR
     *
     *  Supprime le pré-requis du craft sélectionner
     * 
     * @param  int $idLigne
     * @return void
     */
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
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifCraftPR
     *
     *  Modifie le pré-requis du craft sélectionner
     * 
     * @return void
     */
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
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionCraft');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

}