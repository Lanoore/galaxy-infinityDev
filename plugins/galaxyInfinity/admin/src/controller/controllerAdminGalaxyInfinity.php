<?php
namespace App\plugins\galaxyInfinity\admin\src\controller;


use App\plugins\galaxyInfinity\admin\src\model\managerAdminGalaxyInfinity;

use App\config\themes\controller\controllerBase;

class ControllerAdminGalaxyInfinity
{

    private $managerAdminGI;

    private $controllerBase;

    public function __construct(){
            $this->managerAdminGI = new ManagerAdminGalaxyInfinity();

            $this->controllerBase = new ControllerBase();
    }


    public function afficheAdminGestionGI(){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGeneralGIView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI);
            $this->controllerBase->afficheView([$adminGI],'adminGestionGeneralGI');
        }
    }
    



    public function adminAjoutNiveau(){
        $this->managerAdminGI->getDernierNiveau();
        $this->managerAdminGI->niveau = $this->managerAdminGI->niveau +1;

        $addConfirm = $this->managerAdminGI->addNiveau();
        if($addConfirm == true){
            header('Location:index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion');
        }
    }



}