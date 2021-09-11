<?php

namespace App\plugins\chat\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\chat\src\model\managerChat;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */
use App\config\themes\controller\controllerBase;
use Exception;

class ControllerChat{

    /* Mettre ici les variables privates pour les manager */
    private $managerChat;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;

    public function __construct(){
        
        $this->managerChat = new ManagerChat();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * afficheChat
     *  
     * Permet d'afficher le chat général
     * 
     * @return void
     */
    public function afficheChat(){
        if(isset($_SESSION['idUser'])){

                $messagesChat = $this->managerChat->getChat();
        
                $chat = 'plugins/chat/src/view/afficheChat.php';
                $chat = $this->controllerBase->tamponView($chat, $messagesChat);
        
                
                $this->controllerBase->afficheView([$chat],'afficheChat');
        }
    }
    
    /**
     * getChatJs
     *
     *  Récupère le chat et le transforme en fichier json pour l'utiliser dans le javascript et modifier le chat en continu
     * 
     * @return void
     */
    public function getChatJs(){
        if(isset($_SESSION['idUser'])){

            $messagesChat = $this->managerChat->getChat();

            foreach($messagesChat as $message){
                $chat [] = ['id' => $message['id'],'pseudo' => $message['pseudo'],'message' => $message['message'],'dateMessage' => $message['dateMessage']];
            }
            echo json_encode($chat);
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
    
    /**
     * addMessage
     *
     *  Permet d'ajouter un message dans la bdd du chat
     * 
     * @return void
     */
    public function addMessage(){
        if(isset($_SESSION['idUser'])){
            if(!empty($_POST['message'])){
                $this->managerChat->idUser = $_SESSION['idUser'];
                $this->managerChat->message = htmlspecialchars($_POST['message']);
                $addMessage = $this->managerChat->addMessage();
                if($addMessage == true){
                    header('Location:index.php?chat=afficheChat');
                }
            }
            else{
                header('Location:index.php?chat=afficheChat');
            }
            
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }


                    /////////////////// Gestion chat Guilde /////////////////////////

    public function afficheChatGuilde(){
        if(isset($_SESSION['idUser'])){
                $this->managerChat->idGuilde = $_SESSION['idGuilde'];
                $messagesChatGuilde = $this->managerChat->getChatGuilde();

        
                $chatGuilde = 'plugins/chat/src/view/afficheChatGuilde.php';
                $chatGuilde = $this->controllerBase->tamponView($chatGuilde, $messagesChatGuilde);

                
                $this->controllerBase->afficheView([$chatGuilde],'afficheChatGuilde');
            }
    }


    public function getChatGuildeJs(){
        if(isset($_SESSION['idUser']) && $_SESSION['idGuilde'] !== null){
            $this->managerChat->idGuilde = $_SESSION['idGuilde'];
            $messagesChatGuilde = $this->managerChat->getChatGuilde();

            foreach($messagesChatGuilde as $message){
                $chat [] = ['id' => $message['id'],'pseudo' => $message['pseudo'],'message' => $message['message'],'dateMessage' => $message['dateMessage']];
            }
            echo json_encode($chat);
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }


    public function addMessageGuilde(){
        if(isset($_SESSION['idUser']) && $_SESSION['idGuilde'] !== null){
            if(!empty($_POST['message'])){
                $this->managerChat->idGuilde = $_SESSION['idGuilde'];
                $this->managerChat->idUser = $_SESSION['idUser'];
                $this->managerChat->messageGuilde = htmlspecialchars($_POST['message']);
                $addMessageGuilde = $this->managerChat->addMessageGuilde();
                if($addMessageGuilde == true){
                    header('Location:index.php?chat=afficheChatGuilde');
                }
            }
            else{
                header('Location:index.php?chat=afficheChatGuilde');
            }
            
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
}