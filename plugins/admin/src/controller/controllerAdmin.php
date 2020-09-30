<?php

namespace App\plugins\admin\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\admin\src\model\managerAdmin;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */
use App\config\themes\controller\controllerBase;

class ControllerAdmin{

    /* Mettre ici les variables privates pour les manager */
    private $managerAdmin;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;

    public function __construct(){

        $this->managerAdmin = new ManagerAdmin();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * afficheConnexionAdmin
     * 
     *  Affiche la page de connexion Administrateur
     *
     * @return void
     */
    public function afficheConnexionAdmin(){
        $connexionAdmin = 'plugins/admin/src/view/connexionAdminView.php';
        $connexionAdmin = $this->controllerBase->tamponView($connexionAdmin);
        $this->controllerBase->afficheView([$connexionAdmin],'connexionAdminView');
    }
    
    /**
     * connectAdmin
     *
     *  Permet de connecter l'administrateur
     * 
     * @return void
     */
    public function connectAdmin(){
        if(!empty($_POST['identifiant']) && !empty($_POST['password'])&& !preg_match("#[<>]#", $_POST['identifiant'])&& !preg_match("#[<>]#",$_POST['password'])){
                $passwordCorrect = password_verify($_POST['password'], $this->managerAdmin->passwordAdmin);
                if($passwordCorrect){
                    header('Location:index.php?admin=afficheGeneralAdmin');
                    $_SESSION['identifiantAdmin'] =  $_POST['identifiant'];
                    $_SESSION['idAdmin'] = $this->managerAdmin->idAdmin;
                }
                else{
                    header('Location:index.php?admin=afficheConnexion');
                }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
    
    /**
     * afficheGeneralAdmin
     *
     *  Permet d'afficher la page principale d'administration
     * 
     * @return void
     */
    public function afficheGeneralAdmin(){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminGeneralView = 'plugins/admin/src/view/adminGeneralView.php';
            $adminGeneralView = $this->controllerBase->tamponView($adminGeneralView);
            $this->controllerBase->afficheView([$adminGeneralView],'adminGeneral');
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
        
    }
    
    /**
     * disconnectAdmin
     *
     * Permet de déconnecter l'admin !!!ATTENTION Vous déconnecte également si vous êtiez connecté en utilisateur!!! 
     *
     * 
     * @return void
     */
    public function disconnectAdmin(){
        

        session_destroy();

        header('Location: index.php'); //Changer si vous voulez modifier votre page de direction une fois la deconnexion effectuer
    }
    
    /**
     * afficheChangePassword
     *
     *  Permet d'afficher la page de changement de mot de passe de l'administrateur
     * 
     * @return void
     */
    public function afficheChangePassword(){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminChangePassword = 'plugins/admin/src/view/changePasswordView.php';
            $adminChangePassword = $this->controllerBase->tamponView($adminChangePassword);
            $this->controllerBase->afficheView([$adminChangePassword],'changePassword');
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
        
    }
    
    /**
     * changePassword
     *
     *  Permet de changer le mot de passe d'administration
     * 
     * @return void
     */
    public function changePassword(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!preg_match("#[<>]#", $_POST['ancienPassword'])&& !preg_match("#[<>]",$_POST['nouveauPassword'])&& !preg_match("#[<>]#", $_POST['nouveauPasswordVerif']) && $_POST['nouveauPassword'] == $_POST['nouveauPasswordVerif']){

                    $this->managerAdmin->password_hache = password_hash($_POST['nouveauPassword'], PASSWORD_DEFAULT);

                    $passwordCorrect = password_verify($_POST['ancienPassword'], $this->managerAdmin->passwordAdmin);
                    if($passwordCorrect){
                        $this->managerAdmin->identifiantAdmin = $_SESSION['identifiantAdmin'];
                        $modifPassword = $this->managerAdmin->changePassword();
                        if($modifPassword == true){
                            header('Location: index.php?admin=afficheGeneralAdmin');
                        }
                    }
            }
            else{
                header('Location:index.php?admin=afficheChangePassword');
            }
        }
        else{
            header('Location:index.php?admin=afficheConnexion');
        }
    }
}