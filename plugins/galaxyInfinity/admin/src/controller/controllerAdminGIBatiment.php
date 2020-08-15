<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\ManagerAdminGIBatiment;

use App\config\themes\controller\controllerBase;

class ControllerAdminGIBatiment
{
    private $managerAdminGIBatiment;

    private $controllerBase;

    public function __construct(){
        
        $this->managerAdminGIBatiment = new ManagerAdminGIBatiment();

        $this->controllerBase = new ControllerBase();
    }

    public function adminGestionBat(){
        if(isset($_SESSION['identifiantAdmin'])){

    
            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();
            $adminBatNiveau = $this->managerAdminGIBatiment->getBatNiveauAdmin(); 
            $adminBatTempsNiveau = $this->managerAdminGIBatiment->getBatTempsNiveauAdmin(); 

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionBatimentView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['adminBatBase' => $adminBatBase,'adminBatNiveau' =>$adminBatNiveau, 'adminBatTempsNiveau' => $adminBatTempsNiveau]);
            $this->controllerBase->afficheView([$adminGI]);

        }
        else{
            throw new Exception('Varibale de session inconnue');
        }
    }
    
    
    function createBatBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['nom']) && !empty($_POST['descr']) && !empty($_POST['tier'])){
                if(!preg_match("#[<>1-9]#", $_POST['nom']) && !preg_match("#[<>1-9]#",$_POST['descr'])){
                    if($_POST['tier'] >= 1 && $_POST['tier']<=10){
                        
                        $this->managerAdminGIBatiment->nomBat= htmlentities($_POST['nom']);
                        $this->managerAdminGIBatiment->descrBat = htmlentities($_POST['descr']);
                        $this->managerAdminGIBatiment->tierBat = $_POST['tier'];
                        $this->managerAdminGIBatiment->verifBatExist();
                        if($this->managerAdminGIBatiment->batExist == 0){
                            $insertBat =$this->managerAdminGIBatiment->insertBatBase();
                            if($insertBat == true){
                                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                            }
                            else{
                                echo('injection echoué');
                            }
                        }
                        else{
                           echo'Un batiment existe deja sous ce nom';
                        }
                    }
                }
            }
            else{
                echo 'Erreur';
            }
        }
    }
    
    function supprBatBase($idBatiment){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBatiment = $idBatiment;
            $batimentExist = $this->managerAdminGIBatiment->verifBatExist();
            if($batimentExist){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGIBatiment->supprBatBase();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionBatiment");
                }
                else{
                    echo 'erreur';
                }
            }
            
        }
    }   
    function modifBatBase($idBatiment){
            if(isset($_SESSION['identifiantAdmin'])){

            }
    }
    
    function createBatNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['idBat']) && !empty($_POST['niveauBat']) && isset($_POST['craftId']) && isset($_POST['nombreCraft'])&& isset($_POST['itemsId'])&& isset($_POST['nombreItems'])){
                if($_POST['idBat'] >= 1 && $_POST['niveauBat']>= 1){
                    $adminBat = new AdminBatiment(null);
                    $adminBat->idBat = $_POST['idBat'];
                    $adminBat->niveauBat = $_POST['niveauBat'];
                    $adminBat->craftId = $_POST['craftId'];
                    $adminBat->itemsId = $_POST['itemsId'];
                    $adminBat->tempsNiveau = $_POST['tempsNiveau'];
                    if(!empty($_POST['craftId'])){$adminBat->craftId = $_POST['craftId'];}else{$adminBat->craftId = null;}
                    if(!empty($_POST['nombreCraft'])){$adminBat->nombreCraft = $_POST['nombreCraft'];}else{$adminBat->nombreCraft = null;}
                    if(!empty($_POST['itemsId'])){$adminBat->itemsId = $_POST['itemsId'];}else{$adminBat->itemsId = null;}
                    if(!empty($_POST['nombreItems'])){$adminBat->nombreItems = $_POST['nombreItems'];}else{$adminBat->nombreItems = null;}
                    $adminBat->verifBatNiveauExist();
                    if($adminBat->batNiveauExist == 0){
                        $insertBatNiveau = $adminBat->insertBatNiveau();
                        if($insertBatNiveau == true){
                            header('Location:index.php?admin=adminGestionBat');
                        }
                        else{
                            echo('Injection échoué');
                        }
                    }
                    else{
                        echo('Cette ligne existe déjà');
                    }
                }
                else{
                    echo('erreur 2');
                }
            }
            else{
                echo('Erreur 3');
            }
        }
        else{
            echo('erreur 4');
        }
    }
    function actionBatNiveau($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            if(isset($_POST['Modifier'])){
                $adminBat = new AdminBatiment(null);
                $adminBat->idLigne = $idLigne;
                $adminBat->getBatNiveauById();
    
                require('plugins/admin/view/modif/modifBatNiveauView.php');
            }
            elseif (isset($_POST['Supprimer'])) {
                $adminBat = AdminBatiment::supprBatNiveau($idLigne);
                if($adminBat === true){
                    header("Location:index.php?admin=adminGestionBat");
                }
                else{
                    echo 'erreur';
                }
            }
        }
    }
    
    function modifBatNiveau($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminBat = new AdminBatiment(null);
            $adminBat->idLigne = $idLigne;
            $adminBat->idBat = $_POST['idBat'];
            $adminBat->niveauBat = $_POST['niveauBat'];
            $adminBat->tempsNiveau = $_POST['tempsNiveau'];
            if(!empty($_POST['craftId'])){$adminBat->idCraft = $_POST['craftId'];}else{$adminBat->idCraft = null;}
            if(!empty($_POST['nombreCraft'])){$adminBat->nombreCraft = $_POST['nombreCraft'];}else{$adminBat->nombreCraft = null;}
            if(!empty($_POST['itemsId'])){$adminBat->idItems = $_POST['itemsId'];}else{$adminBat->idItems = null;}
            if(!empty($_POST['nombreItems'])){$adminBat->nombreItems = $_POST['nombreItems'];}else{$adminBat->nombreItems = null;}
    
            $confirmModif = $adminBat->modifBatNiveau();
    
            if($confirmModif == true){
                header("Location:index.php?admin=adminGestionBat");
            }
            else{
                echo('erreur');
            }
        }
    }
    
    
    
    function createTempsBatNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminBat = new AdminBatiment(null);
        }
    }
    

}