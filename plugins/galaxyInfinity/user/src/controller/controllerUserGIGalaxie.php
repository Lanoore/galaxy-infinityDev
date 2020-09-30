<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIGalaxie;

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerUserGIGalaxie{

    private $managerUserGIGalaxie;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIGalaxie = new ManagerUserGIGalaxie();

        $this->controllerBase = new ControllerBase();
        
    }
    
    /**
     * afficheGalaxieUser
     *
     * Affiche la galaxie par rapport au systeme sélectionner
     * 
     * @param  int $systeme
     * @return void
     */
    public function afficheGalaxieUser(int $systeme){
        if(isset($_SESSION['idUser'])){

            $this->managerUserGIGalaxie->idSysteme = $systeme;


            $verifExist = $this->managerUserGIGalaxie->verifSystemeExist();
            

            if($verifExist >= 1){

                $galaxie = $this->managerUserGIGalaxie->getSysteme();

                $userGalaxie = 'plugins/galaxyInfinity/user/src/view/userGestionGalaxieView.php';
                $userGalaxie = $this->controllerBase->tamponView($userGalaxie, ['galaxie'=> $galaxie]);
        
                $this->controllerBase->afficheView([$userGalaxie],'userGestionGalaxie');
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheGalaxieUser&systeme=1');
            }
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }

}