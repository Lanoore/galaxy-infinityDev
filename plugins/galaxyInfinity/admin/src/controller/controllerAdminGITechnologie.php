<?php

namespace App\plugins\galaxyInfinity\admin\src\controller;

use App\plugins\galaxyInfinity\admin\src\model\managerAdminGalaxyInfinity;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIItems;
use App\plugins\galaxyInfinity\admin\src\model\managerAdminGIBatiment;


use App\config\themes\controller\controllerBase;

class ControllerAdminGITechnologie
{
    private $managerAdminGalaxyInfinity;
    private $managerAdminGITechnologie;
    private $managerAdminGICraft;
    private $managerAdminGIItems;
    private $managerAdminGIBatiment;

    private $controllerBase;

    public function __construct(){
        
        $this->managerAdminGalaxyInfinity = new ManagerAdminGalaxyInfinity();
        $this->managerAdminGITechnologie = new ManagerAdminGITechnologie();
        $this->managerAdminGICraft = new managerAdminGICraft();
        $this->managerAdminGIItems = new managerAdminGIItems();
        $this->managerAdminGIBatiment = new ManagerAdminGIBatiment();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * adminGestionTechnologie
     *
     * Affiche la gestion des technologies coté admin
     * 
     * @return void
     */
    public function adminGestionTechnologie(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            
            $adminTechnologieBase = $this->managerAdminGITechnologie->getTechnologieBaseAdmin();
            $adminTechnologieNiveau = $this->managerAdminGITechnologie->getTechnologieNiveauAdmin(); 
            $adminTechnologieTempsNiveau = $this->managerAdminGITechnologie->getTechnologieTempsNiveauAdmin();
            $adminTechnologiePR = $this->managerAdminGITechnologie->getTechnologiePRAdmin();

            $niveaux = $this->managerAdminGalaxyInfinity->getNiveaux();
            $crafts = $this->managerAdminGICraft->getCraftBaseAdmin();
            $items = $this->managerAdminGIItems->getItems();
            $adminBatBase = $this->managerAdminGIBatiment->getBatBaseAdmin();

            $adminGI = 'plugins/galaxyInfinity/admin/src/view/adminGestionTechnologieView.php';
            $adminGI = $this->controllerBase->tamponView($adminGI, ['adminTechnologiePR'=>$adminTechnologiePR,'adminBatBase'=>$adminBatBase,'niveaux'=>$niveaux, 'crafts' => $crafts, 'items' => $items,'adminTechnologieBase' => $adminTechnologieBase,'adminTechnologieNiveau' =>$adminTechnologieNiveau, 'adminTechnologieTempsNiveau' => $adminTechnologieTempsNiveau]);
            $this->controllerBase->afficheView([$adminGI],'adminGestionTechnologie');

        }

        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
        
    /**
     * createTechnologieBase
     *
     * 
     * Créer la technologie de base avec son nom,description,tier et l'image
     * 
     * @return void
     */
    public function createTechnologieBase(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!empty($_POST['nom']) && !empty($_POST['descr']) && !empty($_POST['tier']) && !preg_match("#[<>1-9]#", $_POST['nom']) && !preg_match("#[<>]#",$_POST['descr']) && $_POST['tier'] >= 1 && $_POST['tier']<=1){
                        
                        $this->managerAdminGITechnologie->nomTechno= htmlentities($_POST['nom']);
                        $this->managerAdminGITechnologie->descrTechno = htmlentities($_POST['descr']);
                        $this->managerAdminGITechnologie->tierTechno = $_POST['tier'];
                        $verifExist = $this->managerAdminGITechnologie->verifTechnologieExist();
                        if($verifExist == 0){
                            if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0){
                                if($_FILES['image']['size']<= 1000000){
                                    $infosfichier = pathinfo($_FILES['image']['name']);
                                    $extension_upload = $infosfichier['extension'];
                                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                                    if (in_array($extension_upload, $extensions_autorisees))
                                    {
                                        $this->managerAdminGITechnologie->imageTechno = $_POST['nom'].'.'.$infosfichier['extension'];
                                        $insertTechno =$this->managerAdminGITechnologie->insertTechnologieBase();
                                        if($insertTechno == true){
                                            $nomFichier = $_POST['nom'].'.'.$infosfichier['extension'];
                                            move_uploaded_file($_FILES['image']['tmp_name'], '../plugins/galaxyInfinity/admin/public/img/technologie/' . basename($nomFichier));
                                            header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                                        }
                                    }
                                    else{
                                        header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                                    }
                                }
                                else{
                                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                                }
                            }
                            else{
                                header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                            }         
                        }
                        else{
                            header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                        }

            }
            else{
                header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
        
    /**
     * supprTechnologieBase
     *
     * Supprime la technologie de base sélectionner
     * 
     * @param  int $idTechnologie
     * @return void
     */
    public function supprTechnologieBase($idTechnologie){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = $idTechnologie;
            $this->managerAdminGITechnologie->getTechnologieBaseById();

            $technoExist = $this->managerAdminGITechnologie->verifTechnologieExist();
            if($technoExist == 1){
                if(isset($_POST['Supprimer'])){

                    $confirmSuppr = $this->managerAdminGITechnologie->supprTechnologieBase();
                    if($confirmSuppr){
                        unlink('../plugins/galaxyInfinity/admin/public/img/technologie/'. $this->managerAdminGITechnologie->imageCraft);
                        header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");
                    }
                    
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }       
    /**
     * modifTechnologieBase
     *
     *  Modifie la technologie sélectionner
     *  
     * @return void
     */
    public function modifTechnologieBase(){
            if(isset($_SESSION['identifiantAdmin'])){
                
                $this->managerAdminGITechnologie->idTechno = $_POST['idTechno'];
                $this->managerAdminGITechnologie->getTechnologieBaseById();
                
                if(!empty($_POST['nomBat'])){$this->managerAdminGITechnologie->nomTechno = htmlentities($_POST['nomBat']);}
                if(!empty($_POST['descr'])){$this->managerAdminGITechnologie->descrTechno = htmlentities($_POST['descr']);}
                if(!empty($_POST['tier'])){$this->managerAdminGITechnologie->tierTechno = htmlentities($_POST['tier']);}

                $confirmModif = $this->managerAdminGITechnologie->modifTechnologieBase();

                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
        
    /**
     * createTechnologieCraftNiveau
     *
     *  Créer le craft pour la technologie par rapport a son niveau 
     * 
     * @return void
     */
    public function createTechnologieCraftNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            
            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGITechnologie->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGITechnologie->idCraft = null;}
                $this->managerAdminGITechnologie->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGITechnologie->idCraft = null;
                $this->managerAdminGITechnologie->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGITechnologie->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGITechnologie->idItem = null;}
                $this->managerAdminGITechnologie->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGITechnologie->idItem = null;
                $this->managerAdminGITechnologie->nombreItem = null;
            }
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologieCraftNiveauExist();
            
            if($verifExist === 0){
                
                $confirmAdd = $this->managerAdminGITechnologie->createTechnologieCraftNiveau();
                echo('test');
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    /**
     * supprTechnologieCraftNiveau
     *
     * Supprime le craft de la technologie sélectionner
     * 
     * @param  int $idLigne
     * @return void
     */
    public function supprTechnologieCraftNiveau($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idLigne = $idLigne;

            $LigneExist = $this->managerAdminGITechnologie->verifTechnologieCraftNiveauExistById();
            
            if($LigneExist){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGITechnologie->supprTechnologieCraftNiveau();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");
                }

            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }

    
    /**
     * modifTechnologieCraftNiveau
     *
     * Modifie le craft de la technologie sélectionner
     * 
     * @return void
     */
    public function modifTechnologieCraftNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){

            $this->managerAdminGITechnologie->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            if(!empty($_POST['nombreCraft'])){
                if(!empty($_POST['idCraft'])){$this->managerAdminGITechnologie->idCraft = htmlentities($_POST['idCraft']);}else{$this->managerAdminGITechnologie->idCraft = null;}
                $this->managerAdminGITechnologie->nombreCraft = htmlentities($_POST['nombreCraft']);
            }
            else{
                $this->managerAdminGITechnologie->idCraft = null;
                $this->managerAdminGITechnologie->nombreCraft = null;
            }
            
            if(!empty($_POST['nombreItem'])){
                if(!empty($_POST['idItem'])){$this->managerAdminGITechnologie->idItem = htmlentities($_POST['idItem']);}else{$this->managerAdminGITechnologie->idItem = null;}
                $this->managerAdminGITechnologie->nombreItem = htmlentities($_POST['nombreItem']);
            }
            else{
                $this->managerAdminGITechnologie->idItem = null;
                $this->managerAdminGITechnologie->nombreItem = null;
            }
            $ligneExist = $this->managerAdminGITechnologie->verifTechnologieCraftNiveauExistById();


            if($ligneExist){
                
                $confirmModif = $this->managerAdminGITechnologie->modifTechnologieCraftNiveau();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    
    /**
     * createTechnologieTempsNiveau
     *
     * Créer le temps de construction pour la technologie par rapport a son niveau
     * 
     * @return void
     */
    public function createTechnologieTempsNiveau(){
        if(isset($_SESSION['identifiantAdmin'])){
            
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            $this->managerAdminGITechnologie->tempsConstruction = htmlentities($_POST['tempsConstruction']);
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologieTempsNiveauExist();
            
            if($verifExist === 0){
                
                $confirmAdd = $this->managerAdminGITechnologie->createTechnologieTempsNiveau();
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    /**
     * supprTechnologieTempsNiveau
     *
     * Supprime le temps de construction pour la technologie par rapport a son niveau sélectionner
     * 
     * @param  int $idTechnologie
     * @param  int $idNiveau
     * @return void
     */
    public function supprTechnologieTempsNiveau($idTechnologie,$idNiveau){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = $idTechnologie;
            $this->managerAdminGITechnologie->niveauTechno = $idNiveau;

            $verifExist = $this->managerAdminGITechnologie->verifTechnologieTempsNiveauExist();

            if($verifExist === 1){
                if(isset($_POST['Supprimer'])){

                    $this->managerAdminGITechnologie->supprTechnologieTempsNiveau();
                    header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }
    
    /**
     * modifTechnologieTempsNiveau
     *
     *  Modifie le temps de construction de la technologie para rapport a son niveau sélectionner
     * 
     * @return void
     */
    public function modifTechnologieTempsNiveau(){
        
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            $this->managerAdminGITechnologie->niveauTechno = htmlentities($_POST['niveauTechno']);
            $this->managerAdminGITechnologie->tempsConstruction = htmlentities($_POST['tempsConstruction']);
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologieTempsNiveauExist();
            
            if($verifExist === 1){
                $confirmModif =$this->managerAdminGITechnologie->modifTechnologieTempsNiveau();
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }



    
    /**
     * createTechnologiePR
     *
     * Créer le pré-requis de la technologie 
     * 
     * @return void
     */
    public function createTechnologiePR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);
            
            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGITechnologie->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGITechnologie->idBatPR = null;}
                $this->managerAdminGITechnologie->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGITechnologie->idBatPR = null;
                $this->managerAdminGITechnologie->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGITechnologie->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGITechnologie->idTechnoPR = null;}
                $this->managerAdminGITechnologie->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGITechnologie->idTechnoPR = null;
                $this->managerAdminGITechnologie->niveauTechnoPR = null;
            }
            

                $confirmAdd = $this->managerAdminGITechnologie->createTechnologiePR();
                
                if($confirmAdd){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
                
            }
            else{
                header('Location:index.php?admin=afficheConnexion');
            }  
    }
    
    /**
     * supprTechnologiePR
     *
     * Supprime le pré-requis de la technologie sélectionner
     * 
     * @param  int $idLigne
     * @return void
     */
    public function supprTechnologiePR($idLigne){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idLigne = $idLigne;
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologiePRExistById();
            echo('test');
            if($verifExist == 1){
                $confirmSuppr = $this->managerAdminGITechnologie->supprTechnologiePR();
                if($confirmSuppr){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
        
    }
    
    /**
     * modifTechnologiePR
     * 
     * Modifie le pré-requis de la technologie sélectionner
     *
     * @return void
     */
    public function modifTechnologiePR(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerAdminGITechnologie->idLigne = htmlentities($_POST['idLigne']);
            $this->managerAdminGITechnologie->idTechno = htmlentities($_POST['idTechno']);

            if(!empty($_POST['niveauBatPR'])){
                if(!empty($_POST['idBatPR'])){$this->managerAdminGITechnologie->idBatPR = htmlentities($_POST['idBatPR']);}else{$this->managerAdminGITechnologie->idBatPR = null;}
                $this->managerAdminGITechnologie->niveauBatPR = htmlentities($_POST['niveauBatPR']);
            }
            else{
                $this->managerAdminGITechnologie->idBatPR = null;
                $this->managerAdminGITechnologie->niveauBatPR = null;
            }
            
            if(!empty($_POST['niveauTechnoPR'])){
                if(!empty($_POST['idTechnoPR'])){$this->managerAdminGITechnologie->idTechnoPR = htmlentities($_POST['idTechnoPR']);}else{$this->managerAdminGITechnologie->idTechnoPR = null;}
                $this->managerAdminGITechnologie->niveauTechnoPR = htmlentities($_POST['niveauTechnoPR']);
            }
            else{
                $this->managerAdminGITechnologie->idTechnoPR = null;
                $this->managerAdminGITechnologie->niveauTechnoPR = null;
            }
            
            $verifExist = $this->managerAdminGITechnologie->verifTechnologiePRExistById();
            
            if($verifExist == 1){
                $confirmModif = $this->managerAdminGITechnologie->modifTechnologiePR();
                
                if($confirmModif){
                    header('Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie');
                }
            }
            else{
                header("Location:index.php?galaxyInfinity=afficheAdminGestionTechnologie");  
            }
            
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }  
    }

}