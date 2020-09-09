<?php

namespace App\config\themes\controller;



class ControllerBase
{

    public function tamponView($view, $data = null){
        if(!empty($data)){
            extract($data);

        }
        ob_start();
        require $view;
        return $view = ob_get_clean();
        
    }

    public function afficheAccueil(){
        $accueil = '../config/themes/view/accueilView.php';
        $accueil = $this->tamponView($accueil);
        $this->afficheView([$accueil]);

    }

    
    public function afficheView($views = null, $css= null){
        include('../config/themes/public/css/tableFichierCss.php');


        $css = $tableCss[$css];

        require '../config/themes/view/templateBase.php';
    }    

}