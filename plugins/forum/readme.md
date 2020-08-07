


!!!!!!!! Installation !!!!!!!!

ajouter ceci dans le router:


A mettre dans une variable private
    private $controllerForum;
    private $controllerForumAdmin;


A mettre dans la fonction construct
        $this->controllerForum = new ControllerForum();
        $this->controllerForumAdmin = new ControllerForumAdmin();


A mettre dans la fonction run


(if) ou (elseif) (isset($_GET['forum'])) {
                switch ($_GET['forum']) {
                    case 'afficheTopic':
                        $this->controllerForum->afficheTopic($_GET['idTopic'], $_GET['page']);
                        break;
                    case 'afficheCategories':
                        $this->controllerForum->afficheCategories();
                        break;
                    case 'afficheCategorie':
                        $this->controllerForum->afficheCategorie($_GET['idCategorie']);
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
                        $this->controllerBase->afficheAccueil(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
