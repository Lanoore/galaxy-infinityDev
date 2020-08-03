


!!!!!!!! Installation !!!!!!!!

ajouter ceci dans le router:


A mettre dans une variable private
    private $controllerUser;


A mettre dans la fonction construct
$this->controllerUser = new controllerUser();


A mettre dans la fonction run


(if) ou (elseif)(isset($_GET['user'])){
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
                        $this->controllerBase->afficheAccueil(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
