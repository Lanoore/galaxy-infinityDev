!!!!!!!! Installation !!!!!!!!

ajouter ceci dans le router:



A mettre dans une variable private
private $controllerAdmin;


A mettre dans la fonction construct
$this->controllerAdmin = new controllerAdmin();



A mettre dans la fonction run


(if) ou (elseif) (isset($_GET['admin'])) {
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
                        $this->controllerBase->afficheAccueil(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }