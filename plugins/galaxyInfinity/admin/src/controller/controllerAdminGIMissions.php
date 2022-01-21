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

            $adminItems = $this->managerAdminGIMissions->getAllItemsAdmin();
            $adminRessource = $this->managerAdminGIMissions->getAllRessouceAdmin();
            $adminCraft = $this->managerAdminGIMissions->getAllCraftAdmin();
            $adminBat = $this->managerAdminGIMissions->getAllBatAdmin();
            $adminPop = $this->managerAdminGIMissions->getAllPopAdmin();
            $adminMissionsBase = $this->managerAdminGIMissions->getMissionsBaseAdmin();
            $adminRecompensesMissionBase = $this->managerAdminGIMissions->getRecompenseMissionsBaseAdmin();
            $adminPreRequisMissionBase = $this->managerAdminGIMissions->getPreRequisMissionsBaseAdmin();
            $adminQuestionMission = $this->managerAdminGIMissions->getQuestionMissionBaseAdmin();
            $adminReponseMission = $this->managerAdminGIMissions->getReponseMissionBaseAdmin();


            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionMissionsView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['adminReponseMission'=>$adminReponseMission,'adminQuestionMission'=>$adminQuestionMission,'adminPreRequisMissionBase'=>$adminPreRequisMissionBase,'adminPop'=>$adminPop,'adminBat'=>$adminBat,'adminItems'=>$adminItems,'adminRessource'=>$adminRessource,'adminCraft'=>$adminCraft,'adminMissionsBase' => $adminMissionsBase, 'adminRecompensesMissionBase' => $adminRecompensesMissionBase]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionMissions');
        }
    }

    public function createMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){
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

    public function createRecompensesMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['idMission'])){
                $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
                
                if(!empty($_POST['nombreCraft'])){
                    if(!empty($_POST['idCraft'])){$this->managerAdminGIMissions->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGIMissions->idCraft = null;}
                    $this->managerAdminGIMissions->nombreCraft = htmlentities($_POST['nombreCraft']);
                }
                else{
                    $this->managerAdminGIMissions->idCraft = null;
                    $this->managerAdminGIMissions->nombreCraft = null;
                }
                
                if(!empty($_POST['nombreItems'])){
                    if(!empty($_POST['idItem'])){$this->managerAdminGIMissions->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGIMissions->idItem = null;}
                    $this->managerAdminGIMissions->nombreItem = htmlentities($_POST['nombreItems']);
                }
                else{
                    $this->managerAdminGIMissions->idItem = null;
                    $this->managerAdminGIMissions->nombreItem = null;
                }

                if(!empty($_POST['nombreRessource'])){
                    if(!empty($_POST['idRessource'])){$this->managerAdminGIMissions->idRessource = htmlentities($_POST['idRessource']);}else{$this->managerAdminGIMissions->idRessource = null;}
                    $this->managerAdminGIMissions->nombreRessource = htmlentities($_POST['nombreRessource']);
                }
                else{
                    $this->managerAdminGIMissions->idRessource = null;
                    $this->managerAdminGIMissions->nombreRessource = null;
                }

                $verifExist = $this->managerAdminGIMissions->verifRecompenseMissionExist();
                
                if($verifExist === 0){
                
                    $confirmAdd = $this->managerAdminGIMissions->createRecompenseMissionBase();
                    if($confirmAdd){
                        header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                    }
                }
                else{
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionMissions");  
                }
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  

    }

    public function supprRecompensesMissionBase($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIMissions->idLigne = $idLigne;

            $LigneExist = $this->managerAdminGIMissions->verifRecompenseMissionExistById();
            
            if($LigneExist){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGIMissions->supprRecompenseMissionBase();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionMissions");

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


    public function modifRecompenseMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){

            $this->managerAdminGIMissions->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGIMissions->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGIMissions->idCraft = null;}
                $this->managerAdminGIMissions->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGIMissions->idCraft = null;
                $this->managerAdminGIMissions->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGIMissions->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGIMissions->idItem = null;}
                $this->managerAdminGIMissions->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGIMissions->idItem = null;
                $this->managerAdminGIMissions->nombreItem = null;
            }
            if(!empty($_POST['nombreRessource'])){
                if(!empty($_POST['idRessource'])){$this->managerAdminGIMissions->idRessource = htmlentities($_POST['idRessource']);}else{$this->managerAdminGIMissions->idRessource = null;}
                $this->managerAdminGIMissions->nombreRessource = htmlentities($_POST['nombreRessource']);
            }
            else{
                $this->managerAdminGIMissions->idRessource = null;
                $this->managerAdminGIMissions->nombreRessource = null;
            }
            $ligneExist = $this->managerAdminGIMissions->verifRecompenseMissionExistById();
            $verifExist = $this->managerAdminGIMissions->verifRecompenseMissionExist();

            if($ligneExist && $verifExist === 0){
                
                
                $confirmModif = $this->managerAdminGIMissions->modifRecompenseMissionBase();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
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

    public function createPreRequisMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['idMission'])){
                $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
                
                if(!empty($_POST['niveauBat'])){
                    if(!empty($_POST['idBat'])){$this->managerAdminGIMissions->idBat = htmlentities($_POST['idBat']);}else{$this->managerAdminGIMissions->idBat = null;}
                    $this->managerAdminGIMissions->niveauBat = htmlentities($_POST['niveauBat']);
                }
                else{
                    $this->managerAdminGIMissions->idBat = null;
                    $this->managerAdminGIMissions->niveauBat = null;
                }
                
                if(!empty($_POST['nombrePop'])){
                    if(!empty($_POST['idPop'])){$this->managerAdminGIMissions->idPop = htmlentities($_POST['idPop']);}else{$this->managerAdminGIMissions->idPop = null;}
                    $this->managerAdminGIMissions->nombrePop = htmlentities($_POST['nombrePop']);
                }
                else{
                    $this->managerAdminGIMissions->idPop = null;
                    $this->managerAdminGIMissions->nombrePop = null;
                }
                
                    $confirmAdd = $this->managerAdminGIMissions->createPrMissionBase();
                    if($confirmAdd){
                        header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                    }

            }
        }
    }

    public function supprPrMissionBase($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIMissions->idLigne = $idLigne;

            $verifExist = $this->managerAdminGIMissions->verifMissionPRExistById();

            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIMissions->supprMissionPR();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
            }
        }
    }


    public function modifPRMissionBase(){
        if(isset($_SESSION['identifiantAdmin'])){

            $this->managerAdminGIMissions->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
            if(!empty($_POST['niveauBat'])){
                if(!empty($_POST['idBat'])){$this->managerAdminGIMissions->idBat = htmlentities($_POST['idBat']);}else{$this->managerAdminGIMissions->idBat = null;}
                $this->managerAdminGIMissions->niveauBat = htmlentities($_POST['niveauBat']);
            }
            else{
                $this->managerAdminGIMissions->idBat = null;
                $this->managerAdminGIMissions->niveauBat = null;
            }
            
            if(!empty($_POST['nombrePop'])){
                if(!empty($_POST['idPop'])){$this->managerAdminGIMissions->idPop = htmlentities($_POST['idPop']);}else{$this->managerAdminGIMissions->idPop = null;}
                $this->managerAdminGIMissions->nombrePop = htmlentities($_POST['nombrePop']);
            }
            $ligneExist = $this->managerAdminGIMissions->verifMissionPRExistById();


            if($ligneExist){
                
                
                $confirmModif = $this->managerAdminGIMissions->modifPrMissionBase();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
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

    public function createMissionQuestion(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            if(!empty($_POST['idMission']) && !empty($_POST['texteQuestionM'])){
                $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
                $this->managerAdminGIMissions->texteMission = htmlentities($_POST['texteQuestionM']);
                if(!empty($_POST['lastQuestion'])){$this->managerAdminGIMissions->lastQuestion = true;}else{$this->managerAdminGIMissions->lastQuestion = null;}
                if(!empty($_POST['firstQuestion'])){$this->managerAdminGIMissions->firstQuestion = true;}else{$this->managerAdminGIMissions->firstQuestion = null;}
                $addQMission = $this->managerAdminGIMissions->createMissionQuestion();
                if($addQMission){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
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

    public function supprMissionQuestion($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIMissions->idLigne = $idLigne;

            $verifExist = $this->managerAdminGIMissions->verifQuestionMissionExistById();

            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIMissions->supprMissionQ();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
            }
        }
    }

    public function modifMissionQuestion(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['idMission']) && !empty($_POST['texteQuestionM'])){
                $this->managerAdminGIMissions->idLigne = htmlentities($_POST['idLigne']);
                $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
                $this->managerAdminGIMissions->texteMission = htmlentities($_POST['texteQuestionM']);
                if(!empty($_POST['lastQuestion'])){$this->managerAdminGIMissions->lastQuestion = true;}else{$this->managerAdminGIMissions->lastQuestion = null;}
                if(!empty($_POST['firstQuestion'])){$this->managerAdminGIMissions->firstQuestion = true;}else{$this->managerAdminGIMissions->firstQuestion = null;}
                $addQMission = $this->managerAdminGIMissions->modifMissionQuestion();
                if($addQMission){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                }
        }else{
            header("Location:index.php?galaxyInfinity=afficheAdminGestionMissions");  
        }
    }
    else{
        header('Location:index.php?admin=afficheConnexion');
    }  
    }


    public function createMissionReponse(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            if(!empty($_POST['idMission']) && !empty($_POST['texteReponseM']) && !empty($_POST['idTexteQLien']) && !empty($_POST['idTexteQCible'])){
                $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
                $this->managerAdminGIMissions->texteMission = htmlentities($_POST['texteReponseM']);
                $this->managerAdminGIMissions->texteQLien = htmlentities($_POST['idTexteQLien']);
                $this->managerAdminGIMissions->texteQCible = htmlentities($_POST['idTexteQCible']);
                $addQMission = $this->managerAdminGIMissions->createMissionReponse();
                if($addQMission){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
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

    public function supprMissionReponse($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIMissions->idLigne = $idLigne;

            $verifExist = $this->managerAdminGIMissions->verifReponseMissionExistById();

            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIMissions->supprMissionR();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
            }
        }
    }

    public function modifMissionReponse(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['idMission']) && !empty($_POST['texteReponseM']) && !empty($_POST['idTexteQLien']) && !empty($_POST['idTexteQCible'])){
                $this->managerAdminGIMissions->idLigne = htmlentities($_POST['idLigne']);
                $this->managerAdminGIMissions->idMission = htmlentities($_POST['idMission']);
                $this->managerAdminGIMissions->texteMission = htmlentities($_POST['texteReponseM']);
                $this->managerAdminGIMissions->texteQLien = htmlentities($_POST['idTexteQLien']);
                $this->managerAdminGIMissions->texteQCible = htmlentities($_POST['idTexteQCible']);
                $addQMission = $this->managerAdminGIMissions->modifMissionReponse();
                if($addQMission){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionMissions');
                }
        }else{
            header("Location:index.php?galaxyInfinity=afficheAdminGestionMissions");  
        }
    }
    else{
        header('Location:index.php?admin=afficheConnexion');
    }  
    }
}