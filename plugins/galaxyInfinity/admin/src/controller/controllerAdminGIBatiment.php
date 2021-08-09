<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\managerAdminGalaxyInfinity;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIBatiment;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIItems;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGITechnologie;


use App\config\themes\controller\controllerBase;

class ControllerAdminGIBatiment
{
    private $managerAdminGalaxyInfinity;
    private $managerAdminGIBatiment;
    private $managerAdminGICraft;
    private $managerAdminGIItems;

    private $controllerBase;

    public function __construct(){
        
        $this->managerAdminGalaxyInfinity = new ManagerAdminGalaxyInfinity();
        $this->managerAdminGIBatiment = new ManagerAdminGIBatiment();
        $this->managerAdminGICraft = new managerAdminGICraft();
        $this->managerAdminGIItems = new managerAdminGIItems();
        $this->managerAdminGITechnologie = new ManagerAdminGITechnologie();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * adminGestionBat
     *
     *  Affiche la gestion des batiments coté administration
     * 
     * @return void
     */
    public function adminGestionBat(){
        
        if(isset($_SESSION['identifiantAdmin'])){

            
            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();
            $adminBatNiveau = $this->managerAdminGIBatiment->getBatNiveauAdmin();
            $adminBatTempsNiveau = $this->managerAdminGIBatiment->getBatTempsNiveauAdmin();
            $adminBatPR = $this->managerAdminGIBatiment->getBatPRAdmin();
            $adminBatStartPlanete = $this->managerAdminGIBatiment->getBatStartPlanete();

            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();
            $crafts = $this->managerAdminGICraft->getCraftBaseAdmin();
            $items = $this->managerAdminGIItems->getItems();
            $technologies = $this->managerAdminGITechnologie->getTechnologieBaseAdmin();

            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionBatimentView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['adminBatStartPlanete' =>$adminBatStartPlanete, 'adminBatPR'=>$adminBatPR,'technologies' => $technologies,'niveaux'=>$niveaux, 'crafts' => $crafts, 'items' => $items,'adminBatBase' => $adminBatBase,'adminBatNiveau' =>$adminBatNiveau, 'adminBatTempsNiveau' => $adminBatTempsNiveau]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionBatiment');

        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
        
    /**
     * createBatBase
     *
     *  Créer le batiment de base avec nom,tier, description et image
     * 
     * @return void
     */
    public function createBatBase(){

        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['nom']) && !empty($_POST['descr']) && !empty($_POST['tier']) && !preg_match("#[<>1-9]#", $_POST['nom']) && !preg_match("#[<>]#",$_POST['descr'])&& $_POST['tier'] >= 1 && $_POST['tier']<=10){

                
                        $this->managerAdminGIBatiment->nomBat= htmlentities($_POST['nom']);
                        $this->managerAdminGIBatiment->descrBat = htmlentities($_POST['descr']);
                        $this->managerAdminGIBatiment->tierBat = $_POST['tier'];
                        
                        $verifExist = $this->managerAdminGIBatiment->verifBatExist();
                        
                        if($verifExist == 0){   
                            
                                if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0){
                                    if($_FILES['image']['size']<= 2000000){
                                        
                                        $infosfichier = pathinfo($_FILES['image']['name']);
                                        $extension_upload = $infosfichier['extension'];
                                        
                                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                                        if (in_array($extension_upload, $extensions_autorisees)){
                                            $this->managerAdminGIBatiment->imageBat = $_POST['nom'].'.'.$infosfichier['extension'];
                                            $insertBat =$this->managerAdminGIBatiment->insertBatBase();
                                            if($insertBat){
                                                $nomFichier = $_POST['nom'].'.'.$infosfichier['extension'];
                                                
                                                $batBaseImgTrue = move_uploaded_file($_FILES['image']['tmp_name'], 'plugins/galaxyInfinity/admin/public/img/batiment/' . basename($nomFichier));

                                                if($batBaseImgTrue){

                                                    $getBatByName = $this->managerAdminGIBatiment->getBatBaseByName();
                                                    $this->managerAdminGIBatiment->idBat = $getBatByName['id'];
                                                    $getAllPlaneteActive = $this->managerAdminGIBatiment->getAllPlaneteActive();

                                                    foreach($getAllPlaneteActive as $planete){
                                                        $this->managerAdminGIBatiment->idPlanete = $planete['id'];
                                                        $this->managerAdminGIBatiment->insertBatBasePlaneteX();
                                                    }
                                                    
                                                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                                                }
                                                
                                                
                                            }
                                            
                                        }
                                    }
                                }
                            else{
                                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                            }
                        }
                        else{
                            header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                        }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
        
    /**
     * supprBatBase
     * 
     * Supprime le batiment de base
     *
     * @param  int $idBatiment
     * @return void
     */
    public function supprBatBase($idBatiment){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = $idBatiment;

            $this->managerAdminGIBatiment->getBatBaseById();

            $batimentExist = $this->managerAdminGIBatiment->verifBatExist();
            if($batimentExist == 1){
                if(isset($_POST['Supprimer'])){

                    $confirmSuppr = $this->managerAdminGIBatiment->supprBatBase();
                    if($confirmSuppr){
                        unlink('plugins/galaxyInfinity/admin/public/img/batiment/'. $this->managerAdminGIBatiment->imageBat);
                        header("Location:index.php?galaxyInfinity=afficheAdminGestionBatiment");
                    }
                    
                }
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }       
    /**
     * modifBatBase
     *
     *  Modifie le batiment de base
     * 
     * @return void
     */
    public function modifBatBase(){
            if(isset($_SESSION['identifiantAdmin'])){
                $this->managerAdminGIBatiment->idBat = $_POST['idBat'];
                $this->managerAdminGIBatiment->getBatBaseById();

                if(!empty($_POST['nomBat'])){$this->managerAdminGIBatiment->nomBat = htmlentities($_POST['nomBat']);}
                if(!empty($_POST['descr'])){$this->managerAdminGIBatiment->descrBat = htmlentities($_POST['descr']);}
                if(!empty($_POST['tier'])){$this->managerAdminGIBatiment->tierBat = htmlentities($_POST['tier']);}

                $confirmModif = $this->managerAdminGIBatiment->modifBatBase();

                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?admin=afficheConnexion');
            }
    }
        
    /**
     * createBatCraftNiveau
     * 
     * Créer le craft pour le batiment selectionner avec le niveau, le craft et/ou l'items ainsi que le nombre associer
     *
     * @return void
     */
    public function createBatCraftNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIBatiment->niveauBat = htmlentities($_POST['niveauBat']);

            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGIBatiment->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGIBatiment->idCraft = null;}
                $this->managerAdminGIBatiment->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGIBatiment->idCraft = null;
                $this->managerAdminGIBatiment->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGIBatiment->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGIBatiment->idItem = null;}
                $this->managerAdminGIBatiment->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGIBatiment->idItem = null;
                $this->managerAdminGIBatiment->nombreItem = null;
            }
            
            $verifExist = $this->managerAdminGIBatiment->verifBatCraftNiveauExist();
            
            if($verifExist === 0){
                
                $confirmAdd = $this->managerAdminGIBatiment->createBatCraftNiveau();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprBatCraftNiveau
     *
     *  Supprime le craft pour le batiment selectionner
     * 
     * @param  int $idLigne 
     * @return void
     */
    public function supprBatCraftNiveau(int $idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idLigne = $idLigne;

            $LigneExist = $this->managerAdminGIBatiment->verifBatCraftNiveauExistById();
            
            if($LigneExist){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGIBatiment->supprBatCraftNiveau();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionBatiment");
                }
            }else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionBatiment");
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

    
    /**
     * modifBatCraftNiveau
     * 
     *  Modifie le craft pour le batiment selectionner
     *
     * @return void
     */
    public function modifBatCraftNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){

            $this->managerAdminGIBatiment->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIBatiment->niveauBat = htmlentities($_POST['niveauBat']);
            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGIBatiment->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGIBatiment->idCraft = null;}
                $this->managerAdminGIBatiment->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGIBatiment->idCraft = null;
                $this->managerAdminGIBatiment->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGIBatiment->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGIBatiment->idItem = null;}
                $this->managerAdminGIBatiment->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGIBatiment->idItem = null;
                $this->managerAdminGIBatiment->nombreItem = null;
            }
            $ligneExist = $this->managerAdminGIBatiment->verifBatCraftNiveauExistById();


            if($ligneExist){
                
                $confirmModif = $this->managerAdminGIBatiment->modifBatCraftNiveau();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }

        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    
    /**
     * createBatTempsNiveau
     * 
     * Créer le temps pour le batiment selectionner lier a son niveau
     *
     * @return void
     */
    public function createBatTempsNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIBatiment->niveauBat = htmlentities($_POST['niveauBat']);
            $this->managerAdminGIBatiment->tempsConstruction = htmlentities($_POST['tempsConstruction']);
            
            $verifExist = $this->managerAdminGIBatiment->verifBatTempsNiveauExist();
            
            if($verifExist == 0){
                
                $confirmAdd = $this->managerAdminGIBatiment->createBatTempsNiveau();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprBatTempsNiveau
     *
     *  Supprime le temps pour le batiment selectionner lier a son niveau
     * 
     * @param  int $idBatiment
     * @param  int $idNiveau
     * @return void
     */
    public function supprBatTempsNiveau($idBatiment,$idNiveau){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = $idBatiment;
            $this->managerAdminGIBatiment->niveauBat = $idNiveau;

            $verifExist = $this->managerAdminGIBatiment->verifBatTempsNiveauExist();

            if($verifExist === 1){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGIBatiment->supprBatTempsNiveau();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionBatiment");
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionBatiment");
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifBatTempsNiveau
     *
     *  Modifie le temps pour le batiment selectionner lier a son niveau
     * 
     * @return void
     */
    public function modifBatTempsNiveau(){
        
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIBatiment->niveauBat = htmlentities($_POST['niveauBat']);
            $this->managerAdminGIBatiment->tempsConstruction = htmlentities($_POST['tempsConstruction']);
            
            $verifExist = $this->managerAdminGIBatiment->verifBatTempsNiveauExist();
            
            if($verifExist === 1){
                $confirmModif =$this->managerAdminGIBatiment->modifBatTempsNiveau();
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * createBatPR
     *
     *  Créer le pré_requis pour le batiment selectionner avec le nom du batiment et/ou de la technologie ainsi que leurs niveaux associer
     * 
     * @return void
     */
    public function createBatPR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            
            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGIBatiment->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGIBatiment->idBatPR = null;}
                $this->managerAdminGIBatiment->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGIBatiment->idBatPR = null;
                $this->managerAdminGIBatiment->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGIBatiment->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGIBatiment->idTechnoPR = null;}
                $this->managerAdminGIBatiment->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGIBatiment->idTechnoPR = null;
                $this->managerAdminGIBatiment->niveauTechnoPR = null;
            }


                
                $confirmAdd = $this->managerAdminGIBatiment->createBatPR();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * supprBatPR
     *
     *  Supprime le prè-requis du batiment sélectionner
     * 
     * @param  int $idLigne
     * @return void
     */
    public function supprBatPR($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idLigne = $idLigne;
            
            $verifExist = $this->managerAdminGIBatiment->verifBatPRExistById();
            
            if($verifExist == 1){
                
                $confirmSuppr = $this->managerAdminGIBatiment->supprBatPR();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifBatPR
     *
     *  Modifie le pré-requis du batiment sélectionner
     * 
     * @return void
     */
    public function modifBatPR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);

            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGIBatiment->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGIBatiment->idBatPR = null;}
                $this->managerAdminGIBatiment->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGIBatiment->idBatPR = null;
                $this->managerAdminGIBatiment->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGIBatiment->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGIBatiment->idTechnoPR = null;}
                $this->managerAdminGIBatiment->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGIBatiment->idTechnoPR = null;
                $this->managerAdminGIBatiment->niveauTechnoPR = null;
            }

            $verifExist = $this->managerAdminGIBatiment->verifBatPRExistById();

            if($verifExist == 1){
                $confirmModif = $this->managerAdminGIBatiment->modifBatPR();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * createBatStartPlanete
     *
     *  Ajoute le batiment dans la liste des batiments au start de la planete avec le niveau
     * 
     * @return void
     */
    public function createBatStartPlanete(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIBatiment->idNiveau = htmlentities($_POST['idNiveau']);

            $verifExist = $this->managerAdminGIBatiment->verifBatStartPlaneteExist();
            if($verifExist == 0){
                
                $confirmAdd = $this->managerAdminGIBatiment->createBatStartPlanete();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

    
    /**
     * supprBatStartPlanete
     *
     * Supprime le batiment dans la liste des batiments au start de la planete
     * 
     * @param  int $idBatiment
     * @return void
     */
    public function supprBatStartPlanete($idBatiment){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = $idBatiment;
            
            $verifExist = $this->managerAdminGIBatiment->verifBatStartPlaneteExist();
            
            if($verifExist == 1){
                $confirmSuppr = $this->managerAdminGIBatiment->supprBatStartPlanete();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * modifBatStartPlanete
     * 
     * Modifie le batiement dans la liste des batiments au start de la planete 
     *
     * @return void
     */
    public function modifBatStartPlanete(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGIBatiment->idBat = htmlentities($_POST['idBat']);
            $this->managerAdminGIBatiment->idNiveau = htmlentities($_POST['idNiveau']);

            $verifExist = $this->managerAdminGIBatiment->verifBatStartPlaneteExist();
            if($verifExist == 1){
                    
                $confirmAdd = $this->managerAdminGIBatiment->modifBatStartPlanete();
                
                if($confirmAdd){

                    header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
                }
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionBatiment');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }

}