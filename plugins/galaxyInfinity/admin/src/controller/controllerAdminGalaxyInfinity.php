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

    
    /**
     * afficheAdminGestionGI
     *
     *  Affiche la page principale d'administration de Galaxy Infinity
     * 
     * @return void
     */
    public function afficheAdminGestionGI(){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminGI = '../plugins/galaxyInfinity/admin/src/view/adminGeneralGIView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI);
            $this->controllerBase->afficheView([$adminGI],'adminGestionGeneralGI');
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    


    
    /**
     * adminAjoutNiveau
     *
     *  Ajoute un niveau général au jeu en bdd
     * 
     * @return void
     */
    public function adminAjoutNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGI->getDernierNiveau();
            $this->managerAdminGI->niveau = $this->managerAdminGI->niveau +1;
    
            $addConfirm = $this->managerAdminGI->addNiveau();
            if($addConfirm == true){
                header('Location:index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
        
    }



}