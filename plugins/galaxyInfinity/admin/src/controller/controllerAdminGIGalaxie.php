<?php


namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\config\themes\controller\controllerBase;


use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIGalaxie;


class ControllerAdminGIGalaxie
{
    private $controllerBase;

    private $managerAdminGIGalaxie;

    public function __construct(){

        $this->controllerBase = new ControllerBase();

        $this->managerAdminGIGalaxie = new ManagerAdminGIGalaxie();
    }

    public function adminGestionGalaxie(){
        if(isset($_SESSION['identifiantAdmin'])){

            $planetes = $this->managerAdminGIGalaxie->getPlanetes();

            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGestionGalaxieView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['planetes' =>$planetes]);
            $this->controllerBase->afficheView([$adminGI]);

        }
    }

    public function createSystemePlanete(){
        if(isset($_SESSION['identifiantAdmin'])){
            if($_POST['nombreSysteme'] >= 1 AND $_POST['nombrePlanete'] >= 1){
                
                $dernierSysteme = $this->managerAdminGIGalaxie->getLastSysteme();
                $nombreSysteme = $_POST['nombreSysteme'] + $dernierSysteme['systeme'];
                $numeroSyteme = $dernierSysteme['systeme'] + 1;
                
                while($numeroSyteme <= $_POST['nombreSysteme']){
                    $this->managerAdminGIGalaxie->numeroSysteme = $numeroSyteme;
                    
                    $numeroPlanete = 1;
                    while($numeroPlanete <= $_POST['nombrePlanete']){
                        $this->managerAdminGIGalaxie->numeroPlanete = $numeroPlanete;
                        
                        $this->managerAdminGIGalaxie->createSystemePlanete();

                        $numeroPlanete++;
                    }
                    $numeroSyteme++;
                }
                header('Location:index.php?galaxyInfinity=afficheAdminGestionGalaxie');
            }
        }
    }

    public function supprPlanete($idPlanete){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIGalaxie->idPlanete = $idPlanete;

            $verifExist = $this->managerAdminGIGalaxie->verifPlaneteExist();
            if($verifExist == 1){
                $confirmSuppr = $this->managerAdminGIGalaxie->supprPlanete();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionGalaxie');
                }
            }
        }
    }
    

    public function modifSituationPlanete(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIGalaxie->idPlanete = $_POST['idPlanete'];
            $this->managerAdminGIGalaxie->situationPlanete = $_POST['situation'];

            $verifExist = $this->managerAdminGIGalaxie->verifPlaneteExist();
            if($verifExist == 1){
                $confirmModif = $this->managerAdminGIGalaxie->modifSituationPlanete();
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionGalaxie');
                }
            }
        }
    }
}