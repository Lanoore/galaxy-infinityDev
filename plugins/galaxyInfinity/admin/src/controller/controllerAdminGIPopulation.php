<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGIPopulation;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGIBatiment;
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGalaxyInfinity;

use App\config\themes\controller\ControllerBase;

class ControllerAdminGIPopulation
{
    private $managerAdminGIPopulation;
    private $managerAdminGITechnologie;
    private $managerAdminGIBatiment;
    private $managerAdminGalaxyInfinity;

    private $controllerBase;

    public function __construct(){
        $this->managerAdminGIPopulation = new ManagerAdminGIPopulation();
        $this->managerAdminGIBatiment = new ManagerAdminGIBatiment();
        $this->managerAdminGalaxyInfinity = new ManagerAdminGalaxyInfinity();
        $this->managerAdminGITechnologie = new ManagerAdminGITechnologie();

        $this->controllerBase = new ControllerBase;
    }


    public function afficheGestionPopulation(){
        if(isset($_SESSION['identifiantAdmin'])){

            $pops = $this->managerAdminGIPopulation->getPopsBaseAdmin();
            $popsPR = $this->managerAdminGIPopulation->getPopsPRAdmin();

            $technologies = $this->managerAdminGITechnologie->getTechnologieBaseAdmin();
            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();
            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();

            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionPopulationView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['pops'=>$pops,'popsPR'=>$popsPR,'technologies'=>$technologies,'adminBatBase'=>$adminBatBase,'niveaux'=>$niveaux]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionPopulation');
        }

    }

    public function createPopBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIPopulation->nomPop = htmlentities($_POST['nomPop']);
            $this->managerAdminGIPopulation->descrPop = htmlentities($_POST['descr']);
            $this->managerAdminGIPopulation->tierPop = htmlentities($_POST['tier']);


            $this->managerAdminGIPopulation->verifPopExist();

            if($this->managerAdminGIPopulation->popExist == 0){
                if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0){
                    if($_FILES['image']['size']<= 1000000){
                        $infosfichier = pathinfo($_FILES['image']['name']);
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees))
                        {
                            $this->managerAdminGIPopulation->imagePop = $_POST['nomPop'].'.'.$infosfichier['extension'];
                            $insertPop = $this->managerAdminGIPopulation->insertPopBase();
                            if($insertPop){
                                $nomFichier = $_POST['nomPop'].'.'.$infosfichier['extension'];
                                move_uploaded_file($_FILES['image']['tmp_name'], 'plugins/galaxyInfinity/admin/public/img/population/' . basename($nomFichier));
                                header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
                            }
                        }
                    }
                    else{
                        header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
                    }
                 }
                 else{
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
                 }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

    public function supprPopBase($idPop){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIPopulation->idPop = $idPop;
            

            $pop = $this->managerAdminGIPopulation->getPopBaseById();
            $popExist = $this->managerAdminGIPopulation->verifPopExist();
            if($popExist == 1){
                
                if(isset($_POST['Supprimer'])){
                    
                    $supprPop=$this->managerAdminGIPopulation->supprPopBase();
                    if($supprPop){
                        unlink('plugins/galaxyInfinity/admin/public/img/population/'. $this->managerAdminGIPopulation->imagePop);
                        header('Location:index?galaxyInfinity=afficheAdminGestionPopulation');
                    }
                }
            }
            else{
                
                header('Location:index?galaxyInfinity=afficheAdminGestionPopulation');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }


    public function modifPopBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIPopulation->idPop = $_POST['idPop'];
            $this->managerAdminGIPopulation->getPopBaseById();
            
            if(!empty($_POST['nomPop'])){$this->managerAdminGIPopulation->nomPop = htmlentities($_POST['nomPop']);}
            if(!empty($_POST['descr'])){$this->managerAdminGIPopulation->descrPop = htmlentities($_POST['descr']);}
            if(!empty($_POST['tier'])){$this->managerAdminGIPopulation->tierPop = htmlentities($_POST['tier']);}
              
            
            $confirmModif = $this->managerAdminGIPopulation->modifPopBase();

            if($confirmModif){  
                header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }


    public function createPopPR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIPopulation->idPop = htmlentities($_POST['idPop']);
            
            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGIPopulation->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGIPopulation->idBatPR = null;}
                $this->managerAdminGIPopulation->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGIPopulation->idBatPR = null;
                $this->managerAdminGIPopulation->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGIPopulation->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGIPopulation->idTechnoPR = null;}
                $this->managerAdminGIPopulation->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGIPopulation->idTechnoPR = null;
                $this->managerAdminGIPopulation->niveauTechnoPR = null;
            }

                
                $confirmAdd = $this->managerAdminGIPopulation->createPopPR();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
                }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    

    public function supprPopPR($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIPopulation->idLigne = $idLigne;
            
            $verifExist = $this->managerAdminGIPopulation->verifPopPRExistById();

            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIPopulation->supprPopPR();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    

    public function modifPopPR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIPopulation->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGIPopulation->idPop = htmlentities($_POST['idPop']);

            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGIPopulation->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGIPopulation->idBatPR = null;}
                $this->managerAdminGIPopulation->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGIPopulation->idBatPR = null;
                $this->managerAdminGIPopulation->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGIPopulation->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGIPopulation->idTechnoPR = null;}
                $this->managerAdminGIPopulation->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGIPopulation->idTechnoPR = null;
                $this->managerAdminGIPopulation->niveauTechnoPR = null;
            }
            
            $verifExist = $this->managerAdminGIPopulation->verifPopPRExistById();
            
            if($verifExist == 1){
                $confirmModif = $this->managerAdminGIPopulation->modifPopPR();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionPopulation');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

}