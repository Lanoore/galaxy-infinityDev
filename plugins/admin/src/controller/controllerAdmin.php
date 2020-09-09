<?php

namespace App\plugins\admin\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\admin\src\model\ManagerAdmin;

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

    public function afficheConnexionAdmin(){
        $connexionAdmin = '../plugins/admin/src/view/connexionAdminView.php';
        $connexionAdmin = $this->controllerBase->tamponView($connexionAdmin);
        $this->controllerBase->afficheView([$connexionAdmin],'connexionAdminView');
    }

    public function connectAdmin(){
        if(!empty($_POST['identifiant']) && !empty($_POST['password'])){
            if(!preg_match("#[<>]#", $_POST['identifiant'])&& !preg_match("#[<>]#",$_POST['password'])){
                $passwordCorrect = password_verify($_POST['password'], $this->managerAdmin->passwordAdmin);
                if($passwordCorrect){
                    header('Location:index.php?admin=afficheGeneralAdmin');
                    $_SESSION['identifiantAdmin'] =  $_POST['identifiant'];
                    $_SESSION['idAdmin'] = $this->managerAdmin->idAdmin;
                }
                else{
                    echo('erreur');
                }
            }
        }
    }

    public function afficheGeneralAdmin(){
        $adminGeneralView = '../plugins/admin/src/view/adminGeneralView.php';
        $adminGeneralView = $this->controllerBase->tamponView($adminGeneralView);
        $this->controllerBase->afficheView([$adminGeneralView],'adminGeneral');
    }

    public function disconnectAdmin(){
        /**
         * Permet de déconnecter l'admin !!!ATTENTION Vous déconnecte également si vous êtiez connecté en utilisateur!!! 
         */

        session_destroy();

        header('Location: index.php'); //Changer si vous voulez modifier votre page de direction une fois la deconnexion effectuer
    }

    public function afficheChangePassword(){
        if(isset($_SESSION['identifiantAdmin'])){
            $adminChangePassword = '../plugins/admin/src/view/changePasswordView.php';
            $adminChangePassword = $this->controllerBase->tamponView($adminChangePassword);
            $this->controllerBase->afficheView([$adminChangePassword],'changePassword');
        }
        
    }

    public function changePassword(){
        if(isset($_SESSION['identifiantAdmin'])){
            if(!preg_match("#[<>]#", $_POST['ancienPassword'])&& !preg_match("#[<>]",$_POST['nouveauPassword'])&& !preg_match("#[<>]#", $_POST['nouveauPasswordVerif'])){
                if($_POST['nouveauPassword'] == $_POST['nouveauPasswordVerif']){
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
            }
        }
    }
}