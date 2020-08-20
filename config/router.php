<?php


namespace App\config;

use App\config\themes\controller\ControllerBase; //Ne surtout pas supprimer permet d'afficher l'accueil général

/*Ajoutez ici tout les controller de plugins */
use App\plugins\user\src\controller\ControllerUser;
use App\plugins\admin\src\controller\ControllerAdmin;
use App\plugins\chat\src\controller\ControllerChat;
use App\plugins\forum\src\controller\ControllerForum;
use App\plugins\forum\src\controller\ControllerForumAdmin;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGalaxyInfinity;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIBatiment;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIItems;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIRessource;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIGalaxie;



use Exception;

class Router
{ 
    private $controllerBase;
    private $controllerUser;
    private $controllerAdmin;
    private $controllerChat;
    private $controllerForum;
    private $controllerForumAdmin;
    private $controllerAdminGalaxyInfinity;
    private $controllerAdminGIBatiment;
    private $controllerAdminGICraft;
    private $controllerAdminGIItems;
    private $controllerAdminGIRessource;
    private $controllerAdminGITechnologie;
    private $controllerAdminGIGalaxie;

    public function __construct(){
        $this->controllerBase = new ControllerBase();
        $this->controllerUser = new controllerUser();
        $this->controllerAdmin = new controllerAdmin();
        $this->controllerChat = new ControllerChat();
        $this->controllerForum = new ControllerForum();
        $this->controllerForumAdmin = new ControllerForumAdmin();
        $this->controllerAdminGalaxyInfinity = new ControllerAdminGalaxyInfinity();
        $this->controllerAdminGIBatiment = new ControllerAdminGIBatiment();
        $this->controllerAdminGICraft = new ControllerAdminGICraft();
        $this->controllerAdminGIItems = new ControllerAdminGIItems();
        $this->controllerAdminGIRessource = new ControllerAdminGIRessource();
        $this->controllerAdminGITechnologie = new ControllerAdminGITechnologie();
        $this->controllerAdminGIGalaxie =  new ControllerAdminGIGalaxie();

    }

    public function run(){
        try{
            if (isset($_GET['user'])){
                switch ($_GET['user']) {
                    case 'afficheConnexion':
                        $this->controllerUser->afficheConnexion();
                        break;
                    case 'afficheInscription':
                        $this->controllerUser->afficheInscription();
                        break;
                    case 'createUser':
                        $this->controllerUser->createUser();
                        break;
                    case 'connectUser':
                        $this->controllerUser->connectUser();
                        break;
                    case 'disconnectUser':
                        $this->controllerUser->disconnectUser();
                        break;
                    case 'afficheUser':
                        $this->controllerUser->afficheUser();
                        break;
                    
                    default:
                        $this->controllerUser->afficheConnexion(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
            elseif (isset($_GET['admin'])) {
                switch ($_GET['admin']) {
                    case 'afficheConnexion':
                        $this->controllerAdmin->afficheConnexionAdmin();
                        break;
                    case 'afficheGeneralAdmin':
                        $this->controllerAdmin->afficheGeneralAdmin();
                        break;
                    case 'connectAdmin':
                        $this->controllerAdmin->connectAdmin();
                        break;
                    case 'disconnectAdmin':
                        $this->controllerAdmin->disconnectAdmin();
                        break;
                    case 'afficheChangePassword':
                        $this->controllerAdmin->afficheChangePassword();
                        break;
                    case 'changePassword':
                        $this->controllerAdmin->changePassword();
                        break;
                    default:
                        $this->controllerUser->afficheConnexion(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
            elseif (isset($_GET['chat'])){
                switch ($_GET['chat']) {
                    case 'afficheChat':
                        $this->controllerChat->afficheChat();
                        break;
                    case 'addMessage':
                        $this->controllerChat->addMessage();
                        break;
                    default:
                        $this->controllerUser->afficheConnexion(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
            elseif (isset($_GET['forum'])) {
                switch ($_GET['forum']) {
                    case 'afficheTopic':
                        $this->controllerForum->afficheTopic($_GET['idTopic'], $_GET['page']);
                        break;
                    case 'afficheCategories':
                        $this->controllerForum->afficheCategories();
                        break;
                    case 'afficheCategorie':
                        $this->controllerForum->afficheCategorie($_GET['idCategorie'], $_GET['page']);
                        break;
                    case 'afficheCreateTopic':
                        $this->controllerForum->afficheCreateTopic($_GET['idCategorie']);
                        break;
                    case 'createTopic':
                        $this->controllerForum->createTopic($_GET['idCategorie']);
                        break;
                    case 'createCommentaire':
                        $this->controllerForum->createCommentaire($_GET['idTopic']);
                        break;
                    case 'afficheModifTopic':
                        $this->controllerForum->afficheModifTopic($_GET['idTopic']);
                        break;
                    case 'modifTopic':
                        $this->controllerForum->modifTopic($_GET['idTopic']);
                        break;

                    //Partie Admin// 
                    case 'createCategorie':
                        $this->controllerForumAdmin->createCategorie();
                        break;
                    case 'supprCategorie':
                        $this->controllerForumAdmin->supprCategorie($_GET['idCategorie']);
                        break;
                    case 'modifCategorie':
                        $this->controllerForumAdmin->modifCategorie();
                        break;
                    case 'supprCommentaire':
                        $this->controllerForumAdmin->supprCommentaire($_GET['idCommentaire']);
                        break;
                    case 'moveTopic':
                        $this->controllerForumAdmin->moveTopic();
                        break;
                    case 'supprTopic':
                        $this->controllerForumAdmin->supprTopic($_GET['idTopic']);
                        break;
                    case 'afficheAdminForumGestion':
                        $this->controllerForumAdmin->afficheAdminForumGestion();
                        break;
                    default:
                    $this->controllerUser->afficheConnexion(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
            elseif(isset($_GET['galaxyInfinity'])){
                //Gestion partie admin

                    switch ($_GET['galaxyInfinity']) {
                        case 'afficheAdminGalaxyInfinityGestion':
                                $this->controllerAdminGalaxyInfinity->afficheAdminGestionGI();
                            break;
                        case 'adminAjoutNiveau':
                            $this->controllerAdminGalaxyInfinity->adminAjoutNiveau();
                            break;
                        //Partie Ressource
                        case 'afficheAdminGestionRessource':
                            $this->controllerAdminGIRessource->adminGestionRessource();
                            break;
                        case 'createRessourceBase':
                            $this->controllerAdminGIRessource->createRessourceBase();
                            break;    
                        case 'supprRessourceBase':
                            $this->controllerAdminGIRessource->supprRessourceBase($_GET['idRessource']);
                            break;
                        case 'modifRessourceBase':
                            $this->controllerAdminGIRessource->modifRessourceBase();
                            break;
                        //Partie batiment    
                        case 'afficheAdminGestionBatiment':
                            $this->controllerAdminGIBatiment->adminGestionBat();
                            break;
                        case 'createBatBase':
                            $this->controllerAdminGIBatiment->createBatBase();
                            break;
                        case 'supprBatimentBase':
                            $this->controllerAdminGIBatiment->supprBatBase($_GET['idBatiment']);
                            break;
                        case 'modifBatBase':
                            $this->controllerAdminGIBatiment->modifBatBase();
                            break;
                        case 'createBatCraftNiveau':
                            $this->controllerAdminGIBatiment->createBatCraftNiveau();
                            break;
                        case 'supprBatCraftNiveau':
                            $this->controllerAdminGIBatiment->supprBatCraftNiveau($_GET['idLigne']);
                            break;
                        case 'modifBatCraftNiveau':
                            $this->controllerAdminGIBatiment->modifBatCraftNiveau();
                            break;
                        case 'createBatTempsNiveau':
                            $this->controllerAdminGIBatiment->createBatTempsNiveau();
                            break;
                        case 'supprBatTempsNiveau':
                            $this->controllerAdminGIBatiment->supprBatTempsNiveau($_GET['idBatiment'],$_GET['idNiveau']);
                            break;
                        case 'modifBatTempsNiveau':
                            $this->controllerAdminGIBatiment->modifBatTempsNiveau();
                            break;
                        //Partie Technologie    
                        case 'afficheAdminGestionTechnologie':
                            $this->controllerAdminGITechnologie->adminGestionTechnologie();
                            break;
                        case 'createTechnologieBase':
                            $this->controllerAdminGITechnologie->createTechnologieBase();
                            break;
                        case 'supprTechnologieBase':
                            $this->controllerAdminGITechnologie->supprTechnologieBase($_GET['idTechnologie']);
                            break;
                        case 'modifTechnologieBase':
                            $this->controllerAdminGITechnologie->modifTechnologieBase();
                            break;
                        case 'createTechnologieCraftNiveau':
                            $this->controllerAdminGITechnologie->createTechnologieCraftNiveau();
                            break;
                        case 'supprTechnologieCraftNiveau':
                            $this->controllerAdminGITechnologie->supprTechnologieCraftNiveau($_GET['idLigne']);
                            break;
                        case 'modifTechnologieCraftNiveau':
                            $this->controllerAdminGITechnologie->modifTechnologieCraftNiveau();
                            break;
                        case 'createTechnologieTempsNiveau':
                            $this->controllerAdminGITechnologie->createTechnologieTempsNiveau();
                            break;
                        case 'supprTechnologieTempsNiveau':
                            $this->controllerAdminGITechnologie->supprTechnologieTempsNiveau($_GET['idTechnologie'],$_GET['idNiveau']);
                            break;
                        case 'modifTechnologieTempsNiveau':
                            $this->controllerAdminGITechnologie->modifTechnologieTempsNiveau();
                            break;
                        // Partie Craft
                        case 'afficheAdminGestionCraft':
                            $this->controllerAdminGICraft->adminGestionCraft();
                            break;
                        case 'createCraftBase':
                            $this->controllerAdminGICraft->createCraftBase();
                            break;
                        case 'supprCraftBase':
                            $this->controllerAdminGICraft->supprCraftBase($_GET['idCraft']);
                            break;
                        case 'modifCraftBase':                  
                            $this->controllerAdminGICraft->modifCraftBase();
                            break;
                        case 'createCraftCraft':
                            $this->controllerAdminGICraft->createCraftCraft();
                            break;
                        case 'supprCraftCraft':
                            $this->controllerAdminGICraft->supprCraftCraft($_GET['idLigne']);
                            break;
                        case 'modifCraftCraft':
                            $this->controllerAdminGICraft->modifCraftCraft();
                            break;
                        // Partie Items
                        case 'afficheAdminGestionItems':
                            $this->controllerAdminGIItems->adminGestionItems();
                            break;
                        case 'createItemBase':
                            $this->controllerAdminGIItems->createItemBase();
                            break;
                        case 'supprItemBase':
                            $this->controllerAdminGIItems->supprItemBase($_GET['idItem']);
                            break;
                        case 'modifItemBase':
                            $this->controllerAdminGIItems->modifItemBase();
                            break;
                        //Partie Galaxie
                        case 'afficheAdminGestionGalaxie':
                            $this->controllerAdminGIGalaxie->adminGestionGalaxie();
                            break;
                        case 'createSystemePlanete':
                            $this->controllerAdminGIGalaxie->createSystemePlanete();
                            break;
                        case 'supprPlanete':
                            $this->controllerAdminGIGalaxie->supprPlanete($_GET['idPlanete']);
                            break;
                        case 'modifSituationPlanete':
                            $this->controllerAdminGIGalaxie->modifSituationPlanete();
                            break;
                    //Gestion partie user
                        default:
                        $this->controllerUser->afficheConnexion();
                            break;
                    }
                }
            else{
                $this->controllerUser->afficheConnexion();
            }
        }
        catch(Exception $e){
            
        }

    }
}