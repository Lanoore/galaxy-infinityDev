<?php

namespace App\plugins\user\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\user\src\model\managerUser;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */

use App\config\themes\controller\controllerBase;

use App\plugins\galaxyInfinity\user\src\controller\controllerUserGalaxyInfinity;

use Exception;

class ControllerUser
{
    /* Mettre ici les variables privates pour les manager */
    private $managerUser;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;
    private $controllerUserGI;

    public function __construct(){
        
        $this->managerUser = new ManagerUser();

        $this->controllerBase = new ControllerBase();
        $this->controllerUserGI = new ControllerUserGalaxyInfinity();
    }
    
    /**
     * afficheConnexion
     *
     *  Permet d'afficher la page de connexion
     * 
     * @return void
     */
    public function afficheConnexion(){
        $connexion = 'plugins/user/src/view/connexionView.php';
        $connexion = $this->controllerBase->tamponView($connexion);
        $this->templateViewUser([$connexion],'connexionViewUser');
    }
    
    /**
     * afficheInscription
     *
     *  Affiche la page d'inscription 
     * 
     * @return void
     */
    public function afficheInscription(){

        $inscription = 'plugins/user/src/view/inscriptionView.php';
        $inscription = $this->controllerBase->tamponView($inscription);
        $this->templateViewUser([$inscription],'inscriptionView');
    }
    
    /**
     * createUser
     *
     *  Permet de créer l'utilisateur
     * 
     * @return void
     */
    public function createUser(){

        if (!preg_match("#[<>1-9]#", $_POST['pseudo'])&& !preg_match("#[<>]#", $_POST['email'])&& !preg_match("#[<>]#", $_POST['password'])&& !preg_match("#[<>]#", $_POST['repeatPassword'])){
            if(ctype_alnum($_POST['pseudo'])){
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $repeatPassword= htmlspecialchars($_POST['repeatPassword']);
                
                if ($password === $repeatPassword) {
                    $this->managerUser->pseudo = $_POST['pseudo'];
                    $this->managerUser->email = $_POST['email'];
                    $this->managerUser->verifUserExist($this->managerUser->pseudo,$this->managerUser->email);
                    
                    if($this->managerUser->existUser == 0){
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $this->managerUser->pseudo = $pseudo;
                        $this->managerUser->email = $email;
                        $this->managerUser->password = $password;
                        $addUser = $this->managerUser->addUser();
                        
                        if($addUser == true){
                            
                            //Ajouter ici les info de création du joueur sur GalaxyInfinity
                            $this->controllerUserGI->pseudo = $_POST['pseudo'];
                            $this->controllerUserGI->createUserGI();
                            header('Location:index.php?user=afficheConnexion');
                        }
                    }
                }
                else{
                    throw new Exception("Les mots de passe sont différents!");
                }
            }
            else{
                header('Location:index.php?user=afficheInscription');
            }
        }
        else{
            header('Location:index.php?user=afficheInscription');
        }
    }


    
    /**
     * connectUser
     *
     *  Permet de connecter l'utilisateur
     * 
     * @return void
     */
    public function connectUser(){


        if(!preg_match("#[<>1-9]#", $_POST['pseudo'])&& !preg_match("#[<>]#", $_POST['password'])){
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);

            $this->managerUser->pseudo = $pseudo;
            $this->managerUser->getUser();

            if(password_verify($password,$this->managerUser->password)){
                
                $_SESSION['idUser'] = $this->managerUser->idUser;
                $_SESSION['pseudo'] = $this->managerUser->pseudo;
                $_SESSION['email'] = $this->managerUser->email;
                $_SESSION['lastConnexion'] = $this->managerUser->lastConnexion;
                $_SESSION['dateInscription'] = $this->managerUser->dateInscription;
                $_SESSION['idGuilde'] = $this->managerUser->idGuilde;
                $this->controllerUserGI->gestionUserConnectionGI();
                $this->managerUser->updateUserConnection(); //ATTENTION si vous faites des actions sur un temps de connexion faites attention a les placer avant cette fonction qui réinitialise la dernière connection
                header('Location:index.php?galaxyInfinity=afficheHomeUser'); //Changer si vous voulez modifier votre page de direction une fois la connexion effectuer
                
                
            }
            else{
                header('Location:index.php?user=afficheConnexion');
            }
        }
        else{
            header('Location:index.php?user=afficheConnexion');
        }
    }
    
    /**
     * disconnectUser
     *
     *  Permet de déconnecter l'utilisateur
     * 
     * @return void
     */
    public function disconnectUser(){

        $this->managerUser->idUser = $_SESSION['idUser'];

        $this->managerUser->updateUserConnection();
        session_destroy();

        header('Location: index.php'); //Changer si vous voulez modifier votre page de direction une fois la deconnexion effectuer
    }

    
    
    /**
     * afficheUser
     *
     *  Affiche les informations de l'utilisateur 
     * 
     * @return void
     */
    public function afficheUser(){

        if(isset($_SESSION['idUser'])){
            $userInfo = 'plugins/user/src/view/userInfoView.php';
            $userInfo = $this->controllerBase->tamponView($userInfo);
            $this->controllerBase->afficheView([$userInfo],'userInfoView');
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
        
    }


/**
 * 
 * Cette fonction est le template du plugin user différent de celui général du jeu
 * 
 */
    public function templateViewUser($views = null, $css = null){
        include('config/themes/public/css/tableFichierCss.php');

        
        $css = $tableCss[$css];

        require 'plugins/user/src/view/templateViewUser.php';
    }   
    
}