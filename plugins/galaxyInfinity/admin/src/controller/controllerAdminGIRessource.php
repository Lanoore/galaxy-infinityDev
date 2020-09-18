<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGalaxyInfinity;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIRessource;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIBatiment;

use App\config\themes\controller\controllerBase;

class ControllerAdminGIRessource
{
    private $managerAdminGIRessource;
    private $managerAdminGIBatiment;
    private $managerAdminGalaxyInfinity;

    private $controllerBase;
    public function __construct(){

        $this->managerAdminGalaxyInfinity = new ManagerAdminGalaxyInfinity();
        $this->managerAdminGIRessource = new ManagerAdminGIRessource();
        $this->managerAdminGIBatiment = new ManagerAdminGIBatiment();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * adminGestionRessource
     *
     * Affiche la gestion des ressources coté admin
     * 
     * @return void
     */
    public function adminGestionRessource(){
        if(isset($_SESSION['identifiantAdmin'])){

            $ressources = $this->managerAdminGIRessource->getRessources();
            $prodRessources = $this->managerAdminGIRessource->getProdRessources();
            $liaisonRessourceBat = $this->managerAdminGIRessource->getLiaisonRessourceBat();

            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();
            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionRessourceView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI,['liaisonRessourceBat'=>$liaisonRessourceBat,'prodRessources'=>$prodRessources,'adminBatBase'=>$adminBatBase,'niveaux'=>$niveaux,'ressources' => $ressources]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionRessource');
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * createRessourceBase
     *
     * Créer la ressource de base avec son nom et sa description
     * 
     * @return void
     */
    public function createRessourceBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGIRessource->nomRessource = htmlentities($_POST['nom']);
            $this->managerAdminGIRessource->descrRessource = htmlentities($_POST['descr']);

            $verifExist = $this->managerAdminGIRessource->verifRessourceExist();
            
            if($verifExist == 0){
                $confirmAdd = $this->managerAdminGIRessource->createRessourceBase();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprRessourceBase
     *  
     *  Supprime la ressource sélectionner 
     * 
     * @param  int $idRessource
     * @return void
     */
    public function supprRessourceBase($idRessource){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idRessource = $idRessource;
            
            $verifExist = $this->managerAdminGIRessource->verifRessourceExistById();
            if($verifExist == 1){
                $confirmSuppr = $this->managerAdminGIRessource->supprRessourceBase();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifRessourceBase
     *
     * Modifie la ressource sélectionner
     * 
     * @return void
     */
    public function modifRessourceBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idRessource = htmlentities($_POST['idRessource']);

            if(!empty($_POST['nom'])){$this->managerAdminGIRessource->nomRessource = htmlentities($_POST['nom']);}else{$this->managerAdminGIRessource->nomRessource = null;}
            if(!empty($_POST['descr'])){$this->managerAdminGIRessource->descrRessource = htmlentities($_POST['descr']);}else{$this->managerAdminGIRessource->descrRessource = null;}
            
            $verifExist =$this->managerAdminGIRessource->verifRessourceExistById();

            if($verifExist == 1){
                $confirmModif = $this->managerAdminGIRessource->modifRessourceBase();
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * createProdRessourceBat
     *
     * Créer la prod de la ressource par rapport au batiment et au niveau
     * 
     * @return void
     */
    public function createProdRessourceBat(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIRessource->idNiveau = htmlentities($_POST['idNiveau']);
            $this->managerAdminGIRessource->idRessource = htmlentities($_POST['idRessource']);
            $this->managerAdminGIRessource->prodRessource = htmlentities($_POST['prodBatNiveau']);
            
            $verifExist=$this->managerAdminGIRessource->verifProdExist();
            if($verifExist == 0){
                $confirmAdd = $this->managerAdminGIRessource->createProdRessourceBat();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource'); 
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprProdRessourceBat
     *
     * Supprime la prod de la ressource sélectionner
     * 
     * @param  int $idRessource
     * @param  int $idNiveau
     * @param  int $idBatiment
     * @return void
     */
    public function supprProdRessourceBat($idRessource,$idNiveau,$idBatiment){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idRessource = $idRessource;
            $this->managerAdminGIRessource->idNiveau = $idNiveau;
            $this->managerAdminGIRessource->idBat = $idBatiment;
        
            $verifExist = $this->managerAdminGIRessource->verifProdExist();

            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIRessource->supprProdRessourceBat();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifProdRessourceBat
     *
     * Modifie la prod de la ressource sélectionner
     * 
     * @return void
     */
    public function modifProdRessourceBat(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIRessource->idNiveau = htmlentities($_POST['idNiveau']);
            $this->managerAdminGIRessource->idRessource = htmlentities($_POST['idRessource']);
            $this->managerAdminGIRessource->prodRessource = htmlentities($_POST['prodBatNiveau']);

            $verifExist=$this->managerAdminGIRessource->verifProdExist();

            if($verifExist == 1){
                $confirmAdd = $this->managerAdminGIRessource->modifProdRessourceBat();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource'); 
            }
        
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }   
    }

    
    /**
     * createLiaisonRessourceBat
     *
     * Ajoute la liaison entre la ressource et le batiment
     * 
     * @return void
     */
    public function createLiaisonRessourceBat(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idRessource = htmlentities($_POST['idRessource']);
            $this->managerAdminGIRessource->idBat = htmlentities($_POST['idBat']);

            $verifExist = $this->managerAdminGIRessource->verifLiaisonRessourceBatExist();

            if($verifExist == 0){
                $confirmAdd = $this->managerAdminGIRessource->createLiaisonRessourceBat();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource'); 
            }
        
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    /**
     * supprLiaisonRessourceBat
     *
     * Supprime la liaison entre la ressource et le batiment
     * 
     * @param  int $idRessource
     * @param  int $idBatiment
     * @return void
     */
    public function supprLiaisonRessourceBat($idRessource,$idBatiment){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idRessource = $idRessource;
            $this->managerAdminGIRessource->idBat = $idBatiment;

            $verifExist = $this->managerAdminGIRessource->verifLiaisonRessourceBatExist();
            
            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIRessource->supprLiaisonRessourceBat();
                echo('test');
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource'); 
            }
        
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    /**
     * modifLiaisonRessourceBat
     *
     * Modifie la liaison entre la ressource et le batiment
     * 
     * @return void
     */
    public function modifLiaisonRessourceBat(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIRessource->idRessource = htmlentities($_POST['idRessource']);
            $this->managerAdminGIRessource->idBat = htmlentities($_POST['idBat']);

            $verifExist = $this->managerAdminGIRessource->verifLiaisonRessourceBatExist();

            if($verifExist == 1){
                $confirmAdd = $this->managerAdminGIRessource->modifLiaisonRessourceBat();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource');
                }
            }
        
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionRessource'); 
            }
        
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }

}