<?php


namespace App\config;

use App\config\themes\controller\controllerBase; //Ne surtout pas supprimer permet d'afficher l'accueil général

/*Ajoutez ici tout les controller de plugins */
use App\plugins\user\src\controller\controllerUser;
use App\plugins\admin\src\controller\controllerAdmin;
use App\plugins\chat\src\controller\controllerChat;
use App\plugins\forum\src\controller\controllerForum;
use App\plugins\forum\src\controller\controllerForumAdmin;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGalaxyInfinity;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIBatiment;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGICraft;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIItems;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIRessource;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGITechnologie;
use App\plugins\galaxyInfinity\admin\src\controller\controllerAdminGIGalaxie;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGalaxyInfinity;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGIBatiment;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGITechnologie;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGICraft;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGIGalaxie;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGIPlanete;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGIHome;
use App\plugins\galaxyInfinity\user\src\controller\controllerUserGIGuilde;
use App\plugins\galaxyInfinity\user\src\controller\ControllerUserGIPopulation;
use App\plugins\galaxyInfinity\admin\src\controller\ControllerAdminGIPopulation;




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
    private $controllerUserGI;
    private $controllerUserGIBatiment;
    private $controllerUserGITechnologie;
    private $controllerUserGICraft;
    private $controllerUserGIGalaxie;
    private $controllerUserGIPlanete;
    private $controllerUserGIHome;
    private $controllerUserGIGuilde;
    private $controllerUserGIPopulation;
    private $controllerAdminGIPopulation;

    public function __construct(){
        $this->controllerBase = new ControllerBase();
        $this->controllerUser = new ControllerUser();
        $this->controllerAdmin = new ControllerAdmin();
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
        $this->controllerUserGI = new ControllerUserGalaxyInfinity();
        $this->controllerUserGIBatiment = new ControllerUserGIBatiment();
        $this->controllerUserGITechnologie = new ControllerUserGITechnologie();
        $this->controllerUserGICraft = new ControllerUserGICraft();
        $this->controllerUserGIGalaxie = new ControllerUserGIGalaxie();
        $this->controllerUserGIPlanete = new ControllerUserGIPlanete();
        $this->controllerUserGIHome = new ControllerUserGIHome();
        $this->controllerUserGIGuilde = new ControllerUserGIGuilde();
        $this->controllerUserGIPopulation = new ControllerUserGIPopulation();
        $this->controllerAdminGIPopulation = new ControllerAdminGIPopulation();

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
                    case 'getChatJs':
                        $this->controllerChat->getChatJs(); 
                        break;
                    case 'addMessage':
                        $this->controllerChat->addMessage();
                        break;
                    case 'afficheChatGuilde':
                        $this->controllerChat->afficheChatGuilde();
                        break;
                    case 'getChatGuildeJs':
                        $this->controllerChat->getChatGuildeJs(); 
                        break;
                    case 'addMessageGuilde':
                        $this->controllerChat->addMessageGuilde();
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
                        case 'createProdRessourceBat':
                            $this->controllerAdminGIRessource->createProdRessourceBat();
                            break;
                        case 'supprProdRessourceBat':
                            $this->controllerAdminGIRessource->supprProdRessourceBat($_GET['idRessource'], $_GET['idNiveau'], $_GET['idBatiment']);
                            break;
                        case 'modifProdRessourceBat':
                            $this->controllerAdminGIRessource->modifProdRessourceBat();
                            break;
                        case 'createLiaisonRessourceBat':
                            $this->controllerAdminGIRessource->createLiaisonRessourceBat();
                            break;
                        case 'supprLiaisonRessourceBat':
                            $this->controllerAdminGIRessource->supprLiaisonRessourceBat($_GET['idRessource'],$_GET['idBatiment']);
                            break;
                        case 'modifLiaisonRessourceBat':
                            $this->controllerAdminGIRessource->modifLiaisonRessourceBat();
                            break;
                        //Partie population
                        case 'afficheAdminGestionPopulation':
                            $this->controllerAdminGIPopulation->afficheGestionPopulation();
                            break;
                        case 'createPopBase':
                            $this->controllerAdminGIPopulation->createPopBase();
                            break;
                        case 'modifPopBase':
                            $this->controllerAdminGIPopulation->modifPopBase();
                            break;
                        case 'supprPopBase':
                            $this->controllerAdminGIPopulation->supprPopBase($_GET['idPop']);
                            break;
                        case 'createPopPR':
                            $this->controllerAdminGIPopulation->createPopPR();
                            break;
                        case 'supprPopPR':
                            $this->controllerAdminGIPopulation->supprPopPR($_GET['idLigne']);
                            break;
                        case 'modifPopPR':
                            $this->controllerAdminGIPopulation->modifPopPR();
                            break;
                        case 'createFormationPop':
                            $this->controllerAdminGIPopulation->createFormationPop();
                            break;
                        case 'modifPopulationFormation':
                            $this->controllerAdminGIPopulation->modifPopulationFormation();
                            break;
                        case 'supprPopFormation':
                            $this->controllerAdminGIPopulation->supprPopulationFormation($_GET['idLigne']);
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
                        case 'createBatPR':
                            $this->controllerAdminGIBatiment->createBatPR();
                            break;
                        case 'supprBatPR':
                            $this->controllerAdminGIBatiment->supprBatPR($_GET['idLigne']);
                            break;
                        case 'modifBatPR':
                            $this->controllerAdminGIBatiment->modifBatPR();
                            break;
                        case 'createBatStartPlanete':
                            $this->controllerAdminGIBatiment->createBatStartPlanete();
                            break;
                        case 'supprBatStartPlanete':
                            $this->controllerAdminGIBatiment->supprBatStartPlanete($_GET['idBatiment']);    
                            break;
                        case 'modifBatStartPlanete':
                            $this->controllerAdminGIBatiment->modifBatStartPlanete();
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
                        case 'createTechnologiePR':
                            $this->controllerAdminGITechnologie->createTechnologiePR();
                            break;
                        case 'supprTechnologiePR':
                            $this->controllerAdminGITechnologie->supprTechnologiePR($_GET['idLigne']);
                            break;
                        case 'modifTechnologiePR':
                            $this->controllerAdminGITechnologie->modifTechnologiePR();
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
                        case 'createCraftPR':
                            $this->controllerAdminGICraft->createCraftPR();
                            break;
                        case 'supprCraftPR':
                            $this->controllerAdminGICraft->supprCraftPR($_GET['idLigne']);
                            break;
                        case 'modifCraftPR':
                            $this->controllerAdminGICraft->modifCraftPR();
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
                        case 'affichePreRequisUser':
                            $this->controllerUserGI->affichePreRequisUser($_GET['page']);
                            break;
                        case 'afficheReglesUser':
                            $this->controllerUserGI->afficheReglesUser();
                            break;
                        //Partie Home    
                        case 'afficheHomeUser':
                            $this->controllerUserGIHome->afficheHomeUser($_GET['tierSelect']);
                            break;
                        case 'getAllRessources':
                            $this->controllerUserGIHome->allRessources();
                            break;
                        //Partie Batiment    
                        case 'afficheBatimentUser':
                            $this->controllerUserGIBatiment->afficheBatimentUser($_GET['tier']);
                            break;
                        case 'getConstruBatJs':
                            $this->controllerUserGIBatiment->getConstruBatJs();
                            break;
                        case 'addConstructionBat':
                            $this->controllerUserGIBatiment->addConstructionBat($_GET['idBat']);
                            break;
                        //Partie Technologie
                        case 'afficheTechnologieUser':
                            $this->controllerUserGITechnologie->afficheTechnologieUser($_GET['tier']);
                            break;
                        case 'getConstruTechnoJs':
                            $this->controllerUserGITechnologie->getConstruTechnoJs();
                            break;
                        case 'addConstructionTechno':
                            $this->controllerUserGITechnologie->addConstructionTechno($_GET['idTechno']);
                            break;
                        //Partie Craft
                        case 'afficheCraftUser':
                            $this->controllerUserGICraft->afficheCraftUser($_GET['tier']);
                            break;
                        case 'getConstruCraftJs':
                            $this->controllerUserGICraft->getConstruCraftJs();
                            break;
                        case 'addConstructionCraft':
                            $this->controllerUserGICraft->addConstructionCraft($_GET['idCraft']);
                            break;    
                        //Partie Galaxie
                        case 'afficheGalaxieUser':
                            $this->controllerUserGIGalaxie->afficheGalaxieUser($_GET['systeme']);
                            break;
                        //Partie Population
                        case 'affichePopulationUser':
                            $this->controllerUserGIPopulation->affichePopulationUser();
                            break;
                        case 'addProdPopulation':
                            $this->controllerUserGIPopulation->addProdPopulation($_GET['idPop']);
                            break;
                        case 'getFormationPopJs':
                            $this->controllerUserGIPopulation->getFormationPopJs();
                            break;
                            
                        //Partie Guilde
                        case 'afficheGuilde':
                            $this->controllerUserGIGuilde->afficheGuilde();
                            break;  
                        case 'createNewGuilde':
                            $this->controllerUserGIGuilde->createNewGuilde();
                            break;
                        case 'joinGuilde':
                            $this->controllerUserGIGuilde->joinGuilde($_GET['idGuilde']);
                            break;
                        case 'quitterGuilde':
                            $this->controllerUserGIGuilde->quitterGuilde();
                            break;
                        case 'dissoudreGuilde':
                            $this->controllerUserGIGuilde->dissoudreGuilde();
                            break;
                        case 'supprMembreGuilde':
                            $this->controllerUserGIGuilde->supprMembreGuilde($_GET['idMembre']);
                            break;      
                        default:
                        $this->controllerUser->afficheConnexion();//Changer si vous voulez modifier l'action par défaut
                            break;
                    }
                }
            else{
                $this->controllerUser->afficheConnexion();
            }
        }
        catch(Exception $e){
            $css = 'erreurView';
            $view = 'config/themes/view/erreurView.php';
            $erreurMessage = $e->getMessage();
            $erreur = $this->controllerBase->tamponView($view,['erreur' =>$erreurMessage]);
            $this->controllerBase->afficheView([$erreur],$css);

        }

    }
}