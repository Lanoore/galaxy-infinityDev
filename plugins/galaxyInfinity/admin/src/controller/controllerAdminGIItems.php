<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIItems;

use App\config\themes\controller\ControllerBase;

class ControllerAdminGIItems
{
    private $managerAdminGIitems;

    private $controllerBase;

    public function __construct(){
        $this->managerAdminGIitems = new ManagerAdminGIItems;

        $this->controllerBase = new ControllerBase;
    }
    
    /**
     * adminGestionItems
     * 
     * Affiche la gestion des items coté admin
     * 
     *
     * @return void
     */
    public function adminGestionItems(){
        if(isset($_SESSION['identifiantAdmin'])){
            $items = $this->managerAdminGIitems->getItems();

            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionItemsView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['items' =>$items]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionItems');
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * createItemBase
     *
     * Créer l'item de base avec son nom
     * 
     * @return void
     */
    public function createItemBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIitems->nomItems = htmlentities($_POST['nomItems']);
            $itemsExist = $this->managerAdminGIitems->itemExist();

            if($itemsExist == 0){
                $confirmAdd = $this->managerAdminGIitems->addItem();
                if($confirmAdd){

                    $getItemsByName = $this->managerAdminGIitems->getItemsBaseByName();
                    $this->managerAdminGIitems->idItems = $getItemsByName['id'];
                    $getAllPlaneteActive = $this->managerAdminGIitems->getAllPlaneteActive();

                    foreach($getAllPlaneteActive as $planete){
                        $this->managerAdminGIitems->idPlanete = $planete['id'];
                        $this->managerAdminGIitems->insertItemsBasePlaneteX();
                    }
                        
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionItems');
                    
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionItems');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprItemBase
     *
     * Supprime l'item sélectionner
     * 
     * @param  int $idItem
     * @return void
     */
    public function supprItemBase($idItem){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIitems->idItem = $idItem;
            $confirmSuppr = $this->managerAdminGIitems->supprItemBase();
            if($confirmSuppr){
                header('Location:index.php?galaxyInfinity=afficheAdminGestionItems');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifItemBase
     *
     * Modifie l'item sélectionner
     * 
     * @return void
     */
    public function modifItemBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIitems->idItem = $_POST['idItem'];

            if(!empty($_POST['nomItem'])){$this->managerAdminGIitems->nomItem = htmlentities($_POST['nomItem']);}

            $confirmModif = $this->managerAdminGIitems->modifItemBase();

            if($confirmModif == true){
                header('Location:index.php?galaxyInfinity=afficheAdminGestionItems');
            }

        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
}