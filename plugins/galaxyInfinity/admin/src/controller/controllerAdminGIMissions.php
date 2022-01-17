<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;


use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIMissions;

use App\config\themes\controller\ControllerBase;

class ControllerAdminGIMissions
{
    private $managerAdminGIMissions;

    private $controllerBase;

    public function __construct(){

        $this->managerAdminGIMissions = new managerAdminGIMissions();

        $this->controllerBase = new ControllerBase;
    }

    public function adminGestionMissions(){
        if(isset($_SESSION['identifiantAdmin'])){

            $adminMissionsBase = $this->managerAdminGIMissions->getMissionsBaseAdmin();

            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionMissionsView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['adminMissionsBase' => $adminMissionsBase]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionMissions');
        }
    }

    public function createMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            var_dump($_POST);
            if(!empty($_POST['nom']) && !empty($_POST['descr']) && !empty($_POST['type'])&& !empty($_POST['genre'])&& !empty($_POST['niveau'])){
                $this->managerAdminGIMissions->nomMission= htmlentities($_POST['nom']);
                $this->managerAdminGIMissions->descrMission = htmlentities($_POST['descr']);
                $this->managerAdminGIMissions->typeMission = $_POST['type'];
                $this->managerAdminGIMissions->genreMission = $_POST['genre'];
                $this->managerAdminGIMissions->niveauMission = $_POST['niveau'];
                $verifExist = $this->managerAdminGIMissions->verifMissionExist();

                if($verifExist == 0){
                    $insertMission =$this->managerAdminGIMissions->insertMissionBase();
                    if($insertMission){
                        header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                    }else{
                        header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                    }
                    
                }
                else{
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                }
            }
            else{
                echo('test');
            }
        }
    }

    public function supprMissionBase($idMission){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIMissions->idMission = $idMission;
            $this->managerAdminGIMissions->getMissionBaseById();

            $missionExist = $this->managerAdminGIMissions->verifMissionExist();
            if($missionExist == 1){
                if(isset($_POST['Supprimer'])){
                    $supprMission = $this->managerAdminGIMissions->supprMissionBase();
                    if( $supprMission){
                        header("Location:index.php?galaxyInfinity=afficheAdminGestionMissions");
                    }
                    
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionMissions");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    public function modifMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGIMissions->idMission = $_POST['idMission'];
            $this->managerAdminGIMissions->getMissionBaseById();
            
            if(!empty($_POST['nomMission'])){$this->managerAdminGIMissions->nomMission = htmlentities($_POST['nomMission']);}
            if(!empty($_POST['descr'])){$this->managerAdminGIMissions->descrMission = htmlentities($_POST['descr']);}
            if(!empty($_POST['type'])){$this->managerAdminGIMissions->typeMission = htmlentities($_POST['type']);}
            if(!empty($_POST['genre'])){$this->managerAdminGIMissions->genreMission = htmlentities($_POST['genre']);}
            if(!empty($_POST['niveau'])){$this->managerAdminGIMissions->niveauMission = htmlentities($_POST['niveau']);}

            $confirmModif = $this->managerAdminGIMissions->modifMissionBase();

            if($confirmModif){
                header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
            }
        }
    else{
        header('Location:index.php?admin=afficheConnexion');
    }  
}
}