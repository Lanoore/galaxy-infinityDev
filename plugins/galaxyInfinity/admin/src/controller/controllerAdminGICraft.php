<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGICraft;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */

use App\config\themes\controller\controllerBase;

class ControllerAdminGICraft{
    /* Mettre ici les variables privates pour les manager */
    private $managerAdminGICraft;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;


    public function __construct(){
        $this->managerAdminGICraft = new managerAdminGICraft();

        $this->controllerBase = new ControllerBase();
    }

    public function adminGestionCraft(){
        if(isset($_SESSION['identifiantAdmin'])){

            $crafts = $this->managerAdminGICraft->getCraftBaseAdmin();

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionCraftView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['crafts' => $crafts]);
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

}