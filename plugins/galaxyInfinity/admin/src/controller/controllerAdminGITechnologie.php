<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGalaxyInfinity;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGIItems;


use App\config\themes\controller\controllerBase;

class ControllerAdminGITechnologie
{
    private $managerAdminGalaxyInfinity;
    private $managerAdminGITechnologie;
    private $managerAdminGICraft;
    private $managerAdminGIItems;

    private $controllerBase;

    public function __construct(){
        
        $this->managerAdminGalaxyInfinity = new ManagerAdminGalaxyInfinity();
        $this->managerAdminGITechnologie = new ManagerAdminGITechnologie();
        $this->managerAdminGICraft = new managerAdminGICraft();
        $this->managerAdminGIItems = new managerAdminGIItems();

        $this->controllerBase = new ControllerBase();
    }

    public function adminGestionTechnologie(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            
            $adminTechnologieBase = $this->managerAdminGITechnologie->getTechnologieBaseAdmin();
            $adminTechnologieNiveau = $this->managerAdminGITechnologie->getTechnologieNiveauAdmin(); 
            $adminTechnologieTempsNiveau = $this->managerAdminGITechnologie->getTechnologieTempsNiveauAdmin();

            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();
            $crafts = $this->managerAdminGICraft->getCraftBaseAdmin();
            $items = $this->managerAdminGIItems->getItems();

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionTechnologieView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['niveaux'=>$niveaux, 'crafts' => $crafts, 'items' => $items,'adminTechnologieBase' => $adminTechnologieBase,'adminTechnologieNiveau' =>$adminTechnologieNiveau, 'adminTechnologieTempsNiveau' => $adminTechnologieTempsNiveau]);
            $this->controllerBase->afficheView([$adminGI]);

        }
        else{
            throw new Exception('Varibale de session inconnue');
        }
    }
    
    
    public function createTechnologieBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['nom']) && !empty($_POST['descr']) && !empty($_POST['tier'])){
                if(!preg_match("#[<>1-9]#", $_POST['nom']) && !preg_match("#[<>1-9]#",$_POST['descr'])){
                    if($_POST['tier'] >= 1 && $_POST['tier']<=10){
                        
                        $this->managerAdminGITechnologie->nomTechno= htmlentities($_POST['nom']);
                        $this->managerAdminGITechnologie->descrTechno = htmlentities($_POST['descr']);
                        $this->managerAdminGITechnologie->tierTechno = $_POST['tier'];
                        $this->managerAdminGITechnologie->verifTechnologieExist();
                        if($this->managerAdminGITechnologie->technoExist == 0){
                            $insertTechno =$this->managerAdminGITechnologie->insertTechnologieBase();
                            if($insertTechno == true){
                                header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                            }
                            else{
                                echo('injection echoué');
                            }
                        }
                        else{
                           echo'Une technologie existe deja sous ce nom';
                        }
                    }
                }
            }
            else{
                echo 'Erreur';
            }
        }
    }
    
    public function supprTechnologieBase($idTechnologie){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = $idTechnologie;
            $technoExist = $this->managerAdminGITechnologie->verifTechnologieExist();
            if($technoExist){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGITechnologie->supprTechnologieBase();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");
                }
                else{
                    echo 'erreur';
                }
            }
            
        }
    }   
    public function modifTechnologieBase(){
            if(isset($_SESSION['identifiantAdmin'])){
                
                $this->managerAdminGITechnologie->idTechno = $_POST['idTechno'];
                $this->managerAdminGITechnologie->getBatBaseById();
                
                if(!empty($_POST['nomBat'])){$this->managerAdminGITechnologie->nomTechno = htmlentities($_POST['nomBat']);}
                if(!empty($_POST['descr'])){$this->managerAdminGITechnologie->descrTechno = htmlentities($_POST['descr']);}
                if(!empty($_POST['tier'])){$this->managerAdminGITechnologie->tierTechno = htmlentities($_POST['tier']);}

                $confirmModif = $this->managerAdminGITechnologie->modifTechnologieBase();

                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
    }
    
    public function createTechnologieCraftNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            
            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGITechnologie->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGITechnologie->idCraft = null;}
                $this->managerAdminGITechnologie->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGITechnologie->idCraft = null;
                $this->managerAdminGITechnologie->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGITechnologie->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGITechnologie->idItem = null;}
                $this->managerAdminGITechnologie->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGITechnologie->idItem = null;
                $this->managerAdminGITechnologie->nombreItem = null;
            }
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologieCraftNiveauExist();
            
            if($verifExist === 0){
                
                $confirmAdd = $this->managerAdminGITechnologie->createTechnologieCraftNiveau();
                echo('test');
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
        }
    }

    public function supprTechnologieCraftNiveau($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idLigne = $idLigne;

            $LigneExist = $this->managerAdminGITechnologie->verifTechnologieCraftNiveauExistById();
            
            if($LigneExist){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGITechnologie->supprTechnologieCraftNiveau();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");
                }
                else{
                    echo 'erreur';
                }
            }
            
        }
    }


    public function modifTechnologieCraftNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){

            $this->managerAdminGITechnologie->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGITechnologie->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGITechnologie->idCraft = null;}
                $this->managerAdminGITechnologie->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGITechnologie->idCraft = null;
                $this->managerAdminGITechnologie->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGITechnologie->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGITechnologie->idItem = null;}
                $this->managerAdminGITechnologie->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGITechnologie->idItem = null;
                $this->managerAdminGITechnologie->nombreItem = null;
            }
            $ligneExist = $this->managerAdminGITechnologie->verifTechnologieCraftNiveauExistById();


            if($ligneExist){
                
                $confirmModif = $this->managerAdminGITechnologie->modifTechnologieCraftNiveau();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }

        }
    }
    

    public function createTechnologieTempsNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            $this->managerAdminGITechnologie->tempsConstruction = htmlentities($_POST['tempsConstruction']);
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologieTempsNiveauExist();
            
            if($verifExist === 0){
                
                $confirmAdd = $this->managerAdminGITechnologie->createTechnologieTempsNiveau();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
        }
    }

    public function supprTechnologieTempsNiveau($idTechnologie,$idNiveau){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = $idTechnologie;
            $this->managerAdminGITechnologie->niveauTechno = $idNiveau;

            $verifExist = $this->managerAdminGITechnologie->verifTechnologieTempsNiveauExist();

            if($verifExist === 1){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGITechnologie->supprTechnologieTempsNiveau();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");
                }
                else{
                    echo 'erreur';
                }
            }
        }
    }

    public function modifTechnologieTempsNiveau(){
        
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            $this->managerAdminGITechnologie->tempsConstruction = htmlentities($_POST['tempsConstruction']);
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologieTempsNiveauExist();
            
            if($verifExist === 1){
                $confirmModif =$this->managerAdminGITechnologie->modifTechnologieTempsNiveau();
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
        }
    }

}