<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\ManagerUserGIMissions;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGIMissions{
    private $managerUserGIMissions;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIMissions = new ManagerUserGIMissions();

        $this->controllerBase = new ControllerBase();
    }


    public function afficheMissionsUser(){
        if(isset($_SESSION['pseudo'])){

            $missionsBase = $this->managerUserGIMissions->getAllMissions();
            $this->managerUserGIMissions->idPlanete = $_SESSION['idPlaneteActif'];
            $verifMissionEncours = $this->managerUserGIMissions->verifMissionEnCours();

            foreach($missionsBase as $missionBase){
                $countPr = 0;

                

                $this->managerUserGIMissions->idMission = $missionBase['id'];
                $recompenseMission = $this->managerUserGIMissions->getRecMissionX();
                $preRequisMission = $this->managerUserGIMissions->getPrMissionX();
                $verifPrMission = $this->verifPrMission($preRequisMission);


                $missions[] = ['verifPrMission'=>$verifPrMission ,'preRequisMission'=>$preRequisMission,'recMission'=>$recompenseMission,'idMission'=> $missionBase['id'], 'nomMission' => $missionBase['nom'], 'descrMission' => $missionBase['description'], 'typeMission' => $missionBase['type'], 'genreMission' => $missionBase['genre'], 'niveauMission' => $missionBase['niveau']];
            }


            $userMissions = 'plugins/galaxyInfinity/user/src/view/userGestionMissionsView.php';
            $userMissions = $this->controllerBase->tamponView($userMissions,['verifMissionEncours'=>$verifMissionEncours,'missions' => $missions,]);

            $this->controllerBase->afficheView([$userMissions],'userGestionMissions');
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }


    public function verifPrMission($prMision){
        $countPr = 0;
        foreach ($prMision as $prMision) {
            if(!empty($prMision['id_bat'])){
                $this->managerUserGIMissions->idBatRequis = $prMision['id_bat'];
                $batPlanete = $this->managerUserGIMissions->getBatPlaneteX();
                if($prMision['niveau_bat'] > $batPlanete['niveau']){
                    $countPr++;
                }
            }
            if(!empty($prMision['id_pop'])){
                $this->managerUserGIMissions->idPopRequis = $prMision['id_pop'];
                $technoPlanete = $this->managerUserGIMissions->getPopPlaneteX();
                if($prMision['id_pop'] > $technoPlanete['niveau']){
                    $countPr++;
                }
            }
        }
        return $countPr;
    }


    public function lancementMissionTextuel($idMission){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIMissions->idMission = $idMission;
            $this->managerUserGIMissions->idPlanete = $_SESSION['idPlaneteActif'];
            $verifMissionExist = $this->managerUserGIMissions->verifMissionExistById();
            $verifMissionEncours = $this->managerUserGIMissions->verifMissionEnCours();
            if($verifMissionExist == 1 ){
                if($verifMissionEncours == 0){
                    $preRequisMission = $this->managerUserGIMissions->getPrMissionX();
                    $verifPrMission = $this->verifPrMission($preRequisMission);
                        if($verifPrMission == 0){
                            $setMissionEnCours = $this->managerUserGIMissions->setMissionEnCours();
                            $userMission = 'plugins/galaxyInfinity/user/src/view/userMissionTextuelView.php';
                            $userMission = $this->controllerBase->tamponView($userMission);
                
                            $this->controllerBase->afficheView([$userMission],'userGestionMissionTextuel');
                        }
                }
                else{
                    throw new Exception('Une mission est déjà en cours sur cette planète merci de la terminer avant d\'en lancer une autre');
                }
            }
                
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }

    public function getMissionJs($idMission){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIMissions->idMission = $idMission;
            $getMission = $this->managerUserGIMissions->getMission();
            $getAllQMission = $this->managerUserGIMissions->getAllQMission();
            $getAllRMission = $this->managerUserGIMissions->getAllRMission();
            $planeteActive = $_SESSION['idPlaneteActif'];
            $mission [] = ['mission' => $getMission, 'missionTexteQ' => $getAllQMission, 'missionTexteR' =>$getAllRMission, 'planeteActive' =>$planeteActive];
            echo json_encode($mission);
        }
    }

    public function sauvegardeMissionTextuelJs($idMission,$idQuestionActive,$idPlaneteActive){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIMissions->idPlanete = $idPlaneteActive;
            $this->managerUserGIMissions->idMission = $idMission;
            $this->managerUserGIMissions->idQuestionActive = $idQuestionActive;
            $sauvegardeMissionTextuel = $this->managerUserGIMissions->sauvegardeMissionTextuel();
            if($sauvegardeMissionTextuel){
                $getSauvegardeMissionTextuel = $this->managerUserGIMissions->getSauvegardeMissionTextuel();
                $sauvegarde [] =  ['getSauvegardeMissionTextuel' => $getSauvegardeMissionTextuel];
                echo json_encode($sauvegarde);
            }
        }
    }

    public function modifSauvegardeJsMissionTextuel($idQuestionActive,$idPlaneteActive,$idSauvegarde){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIMissions->idPlanete = $idPlaneteActive;
            $this->managerUserGIMissions->idQuestionActive = $idQuestionActive;
            $this->managerUserGIMissions->idSauvegarde = $idSauvegarde;
            $modifSauvegardeMissionTextuel = $this->managerUserGIMissions->modifSauvegardeMissionTextuel();
            if($modifSauvegardeMissionTextuel){
                $getSauvegardeMissionTextuel = $this->managerUserGIMissions->getSauvegardeMissionTextuel();
                $sauvegarde [] =  ['getSauvegardeMissionTextuel' => $getSauvegardeMissionTextuel];
                echo json_encode($sauvegarde);
            }
        }
    }

    public function getSauvegardeJsMissionTextuel(){
        if(isset($_SESSION['pseudo'])){
            $this->managerUserGIMissions->idPlanete = $_SESSION['idPlaneteActif'];
            $getSauvegardeMissionTextuel = $this->managerUserGIMissions->getSauvegardeMissionTextuel();
            $sauvegarde [] =  ['getSauvegardeMissionTextuel' => $getSauvegardeMissionTextuel];
                echo json_encode($sauvegarde);
        }
    }

    public function reprendreMissionEnCours(){
        if(isset($_SESSION['pseudo'])){
            $userMission = 'plugins/galaxyInfinity/user/src/view/userMissionTextuelView.php';
            $userMission = $this->controllerBase->tamponView($userMission);
                
            $this->controllerBase->afficheView([$userMission],'userGestionMissionTextuel');
        }
    }
    
}