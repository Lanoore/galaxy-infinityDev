<?php


namespace App\config;

use App\config\themes\controller\ControllerBase; //Ne surtout pas supprimer permet d'afficher l'accueil général

/*Ajoutez ici tout les controller de plugins */
use App\plugins\user\src\controller\ControllerUser;


use Exception;

class Router
{ 
    private $controllerBase;


    public function __construct(){
        $this->controllerBase = new ControllerBase();

    }

    public function run(){
        try{

        }
        catch(Exception $e){
            
        }

    }
}