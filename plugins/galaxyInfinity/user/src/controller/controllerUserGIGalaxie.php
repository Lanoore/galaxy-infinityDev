<?php

namespace App\plugins\galaxyInfinity\user\src\controller;

use App\plugins\galaxyInfinity\user\src\model\managerUserGIGalaxie;

use App\config\themes\controller\controllerBase;


class ControllerUserGIGalaxie{

    private $managerUserGIGalaxie;

    private $controllerBase;

    public function __construct(){

        $this->managerUserGIGalaxie = new ManagerUserGIGalaxie();

        $this->controllerBase = new ControllerBase();
    }

    public function afficheGalaxieUser(int $systeme){
        if(isset($_SESSION['idUser'])){

            $this->managerUserGIGalaxie->idSysteme = $systeme;


            $verifExist = $this->managerUserGIGalaxie->verifSystemeExist();
            

            if($verifExist >= 1){

                $galaxie = $this->managerUserGIGalaxie->getSysteme();

                $userGalaxie = '../plugins/galaxyInfinity/user/src/view/userGestionGalaxieView.php';
                $userGalaxie = $this->controllerBase->tamponView($userGalaxie, ['galaxie'=> $galaxie]);
        
                $this->controllerBase->afficheView([$userGalaxie],'userGestionGalaxie');
            }
            else{
                header('Location:index.php?galaxyInfinity=afficheGalaxieUser&systeme=1');
            }
        }
    }

}