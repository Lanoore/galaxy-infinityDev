


!!!!!!!! Installation !!!!!!!!

ajouter ceci dans le router:


A mettre dans une variable private
private $controllerChat;


A mettre dans la fonction construct
$this->controllerChat = new ControllerChat();


A mettre dans la fonction run
(if) ou (elseif)(isset($_GET['chat'])){
                switch ($_GET['chat']) {
                    case 'afficheChat':
                        $this->controllerChat->afficheChat();
                        
                        break;
                    case 'addMessage':
                        $this->controllerChat->addMessage();
                        break;
                    default:
                        $this->controllerBase->afficheAccueil(); //Changer si vous voulez modifier l'action par défaut
                        break;
                }
            }
            else{
                $this->controllerBase->afficheAccueil();
            }