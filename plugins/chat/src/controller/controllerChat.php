<?php

namespace App\plugins\chat\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\chat\src\model\ManagerChat;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */
use App\config\themes\controller\controllerBase;

class ControllerChat{

    /* Mettre ici les variables privates pour les manager */
    private $managerChat;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;

    public function __construct(){
        
        $this->managerChat = new ManagerChat();

        $this->controllerBase = new ControllerBase();
    }

    public function afficheChat(){
        if($_SESSION['idUser']){

        $messagesChat = $this->managerChat->getChat();
        
        $chat = '../plugins/chat/src/view/afficheChat.php';
        $chat = $this->controllerBase->tamponView($chat, $messagesChat);

        
        $this->controllerBase->afficheView([$chat],'afficheChat');
        }
    }

    public function addMessage(){
        if($_SESSION['idUser']){
            if(!empty($_POST['message'])){
                $this->managerChat->idUser = $_SESSION['idUser'];
                $this->managerChat->message = $_POST['message'];
                $addMessage = $this->managerChat->addMessage();
                if($addMessage == true){
                    header('Location:index.php?chat=afficheChat');
                }
            }
            else{
                header('Location:index.php?chat=afficheChat');
            }
            
        }
    }
}