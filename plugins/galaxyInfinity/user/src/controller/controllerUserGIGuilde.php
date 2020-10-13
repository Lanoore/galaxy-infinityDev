<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIGuilde;

use App\config\themes\controller\controllerBase;


use Exception;

class ControllerUserGIGuilde{

    private $managerUserGIGuilde;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIGuilde = new managerUserGIGuilde();

        $this->controllerBase = new ControllerBase();

        if(isset($_SESSION['idGuilde'])){
            //verifier si la guilde existe encore si n existe plus supprimer la session idguilde
            $this->managerUserGIGuilde->idGuilde = $_SESSION['idGuilde'];
            $verifExist = $this->managerUserGIGuilde->verifGuildeExist();
            if($verifExist == 0){
                unset($_SESSION['idGuilde']);
            }
        }


    }


    public function afficheGuilde(){
        if(isset($_SESSION['idUser'])){
            
            $this->managerUserGIGuilde->idUser = $_SESSION['idUser'];
            $verifGuildeJoueur = $this->managerUserGIGuilde->verifJoueurInGuilde();
            $guilde = null;
            $infoGuilde = null;
            if($verifGuildeJoueur['idGuilde'] != null){
                $this->managerUserGIGuilde->idGuilde = $_SESSION['idGuilde'];
                $guilde = $this->managerUserGIGuilde->getAllMembreGuilde();
                $infoGuilde = $this->managerUserGIGuilde->getGuilde();
                
            }
            else{
                $guilde = $this->managerUserGIGuilde->getAllGuilde();
            }

            $userguilde = 'plugins/galaxyInfinity/user/src/view/userGestionGuildeView.php';
            $userguilde = $this->controllerBase->tamponView($userguilde, ['guilde' => $guilde, 'infoGuilde' => $infoGuilde]);
        
            $this->controllerBase->afficheView([$userguilde],'userGestionGuilde');
        }
    }


    public function createNewGuilde(){
        if(isset($_SESSION['idUser']) AND !isset($_SESSION['idGuilde'])){
            if(isset($_POST['nomGuilde']) AND !empty($_POST['nomGuilde'])){
                $this->managerUserGIGuilde->nomGuilde = $_POST['nomGuilde'];
                $this->managerUserGIGuilde->idUser = $_SESSION['idUser'];
                $verif = $this->managerUserGIGuilde->createNewGuilde();
                $this->managerUserGIGuilde->getGuildeByName();
                
                if($verif){
                    
                    $this->managerUserGIGuilde->setUserNewGuilde();
                    $_SESSION['idGuilde'] = $this->managerUserGIGuilde->idGuilde;
                    header('Location: index.php?galaxyInfinity=afficheGuilde');
                }

                
            }
        }
    }

    public function joinGuilde(int $idGuilde){
        if(isset($_SESSION['idUser']) AND !isset($_SESSION['idGuilde']) AND isset($idGuilde) AND !empty($idGuilde)){
            $this->managerUserGIGuilde->idGuilde = $idGuilde;
            $verifExist = $this->managerUserGIGuilde->verifGuildeExist();
            if($verifExist == 1){
                $this->managerUserGIGuilde->idUser = $_SESSION['idUser'];
                $this->managerUserGIGuilde->joinGuilde();
                $_SESSION['idGuilde']= $idGuilde;
                header('Location:index.php?galaxyInfinity=afficheGuilde');
            }
        }
    }

    public function quitterGuilde(){
        if(isset($_SESSION['idUser']) AND isset($_SESSION['idGuilde'])){
            $this->managerUserGIGuilde->idGuilde = $_SESSION['idGuilde'];
            $getGuilde = $this->managerUserGIGuilde->getGuilde();
            if($getGuilde['idChefGuilde'] != $_SESSION['idGuilde']){
                $this->managerUserGIGuilde->idUser = $_SESSION['idUser'];
                $supprMembreGuilde = $this->managerUserGIGuilde->quitterGuilde();
                unset($_SESSION['idGuilde']);
                header('Location:index.php?galaxyInfinity=afficheGuilde');
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheGuilde');
            }
        }
    }

    public function dissoudreGuilde(){
        if(isset($_SESSION['idUser']) AND isset($_SESSION['idGuilde'])){
            $this->managerUserGIGuilde->idGuilde = $_SESSION['idGuilde'];
            $getGuilde = $this->managerUserGIGuilde->getGuilde();
            if($getGuilde['idChefGuilde'] == $_SESSION['idUser']){
                $membres = $this->managerUserGIGuilde->getAllMembreGuilde();
                foreach($membres as $membres){
                    $this->managerUserGIGuilde->idUser = $membres['id'];
                    $this->managerUserGIGuilde->supprMembreGuilde();
                    $this->managerUserGIGuilde->supprGuilde();
                    unset($_SESSION['idGuilde']);
                    header('Location:index.php?galaxyInfinity=afficheGuilde');
                }
            }else{
                header('Location:index.php?galaxyInfinity=afficheGuilde');
            }
        }
    }

    public function supprMembreGuilde($idMembre){
        if(isset($_SESSION['idUser']) AND isset($_SESSION['idGuilde'])){
            $this->managerUserGIGuilde->idGuilde = $_SESSION['idGuilde'];
            $getGuilde = $this->managerUserGIGuilde->getGuilde();

            if($getGuilde['idChefGuilde'] == $_SESSION['idUser']){
                echo('test');
                $this->managerUserGIGuilde->idUser = $idMembre;
                $this->managerUserGIGuilde->supprMembreGuilde();
                header('Location:index.php?galaxyInfinity=afficheGuilde');
            }
        }
    }


}