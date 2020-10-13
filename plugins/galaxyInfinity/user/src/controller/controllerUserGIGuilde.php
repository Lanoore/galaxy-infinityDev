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


    }


    public function afficheGuilde(){
        if(isset($_SESSION['idUser'])){
            
            $this->managerUserGIGuilde->idUser = $_SESSION['idUser'];
            $verifGuildeJoueur = $this->managerUserGIGuilde->verifJoueurInGuilde();
            $guilde = null;
            if($verifGuildeJoueur['idGuilde'] != null){
                

                
            }
            else{
                $guilde = $this->managerUserGIGuilde->getAllGuilde();
            }

            $userguilde = 'plugins/galaxyInfinity/user/src/view/userGestionGuildeView.php';
            $userguilde = $this->controllerBase->tamponView($userguilde, ['guilde' => $guilde]);
        
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


}