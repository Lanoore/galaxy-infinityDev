<?php


namespace App\config;

use App\config\themes\controller\ControllerBase; //Ne surtout pas supprimer permet d'afficher l'accueil général

/*Ajoutez ici tout les controller de plugins */
use App\plugins\user\src\controller\ControllerUser;
use App\plugins\admin\src\controller\ControllerAdmin;
use App\plugins\chat\src\controller\ControllerChat;
use App\plugins\forum\src\controller\ControllerForum;
use App\plugins\forum\src\controller\ControllerForumAdmin;



use Exception;

class Router
{ 
    private $controllerBase;
    private $controllerUser;
    private $controllerAdmin;
    private $controllerChat;
    private $controllerForum;
    private $controllerForumAdmin;


    public function __construct(){
        $this->controllerBase = new ControllerBase();
        $this->controllerUser = new controllerUser();
        $this->controllerAdmin = new controllerAdmin();
        $this->controllerChat = new ControllerChat();
        $this->controllerForum = new ControllerForum();
        $this->controllerForumAdmin = new ControllerForumAdmin();

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
            else{
                $this->controllerUser->afficheConnexion();
            }
        }
        catch(Exception $e){
            
        }

    }
}