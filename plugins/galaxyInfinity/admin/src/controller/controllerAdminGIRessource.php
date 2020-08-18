<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIRessource;

use App\config\themes\controller\controllerBase;

class ControllerAdminGIRessource
{
    private $managerAdminGIRessource;

    private $controllerBase;
    public function __construct(){

        $this->managerAdminGIRessource = new ManagerAdminGIRessource();

        $this->controllerBase = new ControllerBase();
    }

    public function adminGestionRessource(){
        if(isset($_SESSION['identifiantAdmin'])){

            $ressources = $this->managerAdminGIRessource->getRessources();

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionRessourceView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI,['ressources' => $ressources]);
            $this->controllerBase->afficheView([$adminGI]);
        }
    }

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
        }
    }

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
        }
    }

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
            
        }
    }

}