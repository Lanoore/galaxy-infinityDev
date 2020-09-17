<?php

namespace App\plugins\forum\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\forum\src\model\ManagerForumAdmin;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */

use App\config\themes\controller\controllerBase;

class ControllerForumAdmin{
    /* Mettre ici les variables privates pour les manager */
    private $managerForumAdmin;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;


    public function __construct(){
        $this->managerForumAdmin = new ManagerForumAdmin();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * createCategorie
     *
     *  Crée une catégorie
     * 
     * @return void
     */
    public function createCategorie(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerForumAdmin->nomCategorie = $_POST['nom'];
            $this->managerForumAdmin->createCategorie();
            header('Location:index.php?forum=afficheAdminForumGestion');
        }
    }   
    
    /**
     * supprCategorie
     *
     *  Supprime une catégorie
     * 
     * @param  int $idCategorie
     * @return void
     */
    public function supprCategorie($idCategorie){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerForumAdmin->idCategorie = $idCategorie;
            $categorieExist = $this->managerForumAdmin->categorieExist();
            if($categorieExist){
                if(isset($_POST['Supprimer'])){
                    $this->managerForumAdmin->supprCategorie();
                    header('Location:index.php?forum=afficheAdminForumGestion');
                }
            }
        }
    }
    
    /**
     * modifCategorie
     *
     * Modifi une catégorie
     * 
     * @return void
     */
    public function modifCategorie(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerForumAdmin->nomCategorie = $_POST['nomCategorie'];
            $this->managerForumAdmin->idCategorie = $_POST['idCategorie'];
            $categorieExist = $this->managerForumAdmin->categorieExist();

            if($categorieExist){
                $this->managerForumAdmin->modifCategorie();
                header('Location:index.php?forum=afficheAdminForumGestion');
            }
        }
    }
    
    /**
     * supprCommentaire
     *
     *  Supprime un commentaire
     * 
     * @param  int $idCommentaire
     * @return void
     */
    public function supprCommentaire($idCommentaire){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerForumAdmin->idCommentaire = $idCommentaire;
            $commentaireExist = $this->managerForumAdmin->commentaireExist();
            if($commentaireExist){
                if(isset($_POST['Supprimer'])){
                    $this->managerForumAdmin->supprCommentaire();
                    header('Location:index.php?forum=afficheAdminForumGestion');
                }
            }
        }
    }
    
    /**
     * moveTopic
     * 
     * Déplace le topic vers la catégorie cible
     *
     * @return void
     */
    public function moveTopic(){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerForumAdmin->idTopic = $_POST['idTopic'];
            $this->managerForumAdmin->idCategorie = $_POST['idCategorie'];
            $topicExist = $this->managerForumAdmin->categorieExist();
            $categorieExist = $this->managerForumAdmin->topicExist();
            if($topicExist == true && $categorieExist == true){
                $this->managerForumAdmin->moveTopic();
                header('Location:index.php?forum=afficheAdminForumGestion');
            }
        }
    }
    
    /**
     * supprTopic
     *
     *  Supprime le topic
     * 
     * @param  int $idTopic
     * @return void
     */
    public function supprTopic($idTopic){
        if(isset($_SESSION['identifiantAdmin'])){
            $this->managerForumAdmin->idTopic = $idTopic;
            $topicExist = $this->managerForumAdmin->topicExist();
            if($topicExist){
                if(isset($_POST['Supprimer'])){
                    $this->managerForumAdmin->supprTopic();
                    header('Location:index.php?forum=afficheAdminForumGestion');
                }
            }
        }
    }
    
    /**
     * afficheAdminForumGestion
     *
     *  Affiche la page général d'administration du forum
     * 
     * @return void
     */
    public function afficheAdminForumGestion(){

        if(isset($_SESSION['identifiantAdmin'])){

            $categories = $this->managerForumAdmin->getCategories();


            $topics = $this->managerForumAdmin->getTopics();
            

            $commentaires = $this->managerForumAdmin->getCommentaires();


            
            
            $gestionForum = '../plugins/forum/src/view/admin/forumAdminGestionView.php';
            $gestionForum = $this->controllerBase->tamponView($gestionForum, ['categories'=>$categories, 'topics'=>$topics , 'commentaires'=>$commentaires]);
            $this->controllerBase->afficheView([$gestionForum],'forumAdminGestionView');
        }
        else{
            echo 'Veuillez vous connectez en admin';
        }
    }
}    