<?php

namespace App\plugins\forum\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\forum\src\model\managerForum;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */

use App\config\themes\controller\controllerBase;

use Exception;

class ControllerForum{
    /* Mettre ici les variables privates pour les manager */
    private $managerForum;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;


    public function __construct(){
        $this->managerForum = new ManagerForum();

        $this->controllerBase = new ControllerBase();
    }
    
    /**
     * afficheTopic
     *
     *  Permet d'afficher un topic précis avec son id
     * 
     * @param  int $idTopic
     * @param  int $page
     * @return void
     */
    public function afficheTopic($idTopic,$page){
        if(isset($_SESSION['idUser'])){
            $this->managerForum->idTopic = $idTopic;

            $topicExist = $this->managerForum->topicExist();
            if(empty($topicExist)){
                header('Location:index.php?forum=afficheCategories');
            }
            $topic = $this->managerForum->getTopic();

            $this->managerForum->getNbCommentaires();
            $commentairesParPage = 10; //Chiffre a changer pour modifier le nombre de commentaires sur une page
            
            $commentairesTotaux = ceil($this->managerForum->nbCommentaires/$commentairesParPage);

            if(isset($page) AND !empty($page) AND $page > 0 AND $page <=$commentairesTotaux){
                $page = intval($page);
                $pageCourante = $page;
            }else{
                $pageCourante = 1;
            }

            $depart = ($pageCourante-1)*$commentairesParPage;
            $this->managerForum->depart = $depart;
            $this->managerForum->commentairesParPage = $commentairesParPage;
            $commentaires = $this->managerForum->getCommentaires();

            $pagination['commentairesTotaux'] = $commentairesTotaux;
            $pagination['pageCourante'] = $pageCourante;


            $topicForum = 'plugins/forum/src/view/user/topicView.php';
            $topicForum = $this->controllerBase->tamponView($topicForum, ['topic' => $topic, 'commentaires' => $commentaires,'pagination' =>$pagination]);
            $this->controllerBase->afficheView([$topicForum],'topicView');
        }
    }


    
    /**
     * afficheCategories
     *  
     *  Permet d'afficher les différentes catégories
     * 
     * @return void
     */
    public function afficheCategories(){
        if(isset($_SESSION['idUser'])){
            $categories = $this->managerForum->getCategories();
            
            foreach ($categories as $categorie) {

                $lastTopic = $this->managerForum->getLastTopicCategorie($categorie['id']);
                $lastTopics[$categorie['id']] = $lastTopic;

            }
            
            $forumCategories = 'plugins/forum/src/view/user/categoriesView.php';
            $forumCategories = $this->controllerBase->tamponView($forumCategories, ['categories' => $categories, 'lastTopics' => $lastTopics]);
            $this->controllerBase->afficheView([$forumCategories],'categoriesView');
        }

    }
    
    /**
     * afficheCategorie
     *
     *  Permet d'afficher une catégorie précise grâce a son id
     * 
     * @param  int $idCategorie
     * @param  int $page
     * @return void
     */
    public function afficheCategorie($idCategorie,$page){
        if(isset($_SESSION['idUser'])){
            $this->managerForum->idCategorie = $idCategorie;
            $categorieExist = $this->managerForum->categorieExist();
            if(empty($categorieExist)){
                header('Location:index.php?forum=afficheCategories');
            }

            $this->managerForum->getNbTopics();
            $topicsParPage = 10;

            $topicsTotaux = ceil($this->managerForum->nbTopics/$topicsParPage);

            if(isset($page) AND !empty($page) AND $page > 0 AND $page <= $topicsTotaux){
                $page = intval($page);
                $pageCourante = $page;
            }
            else{
                $pageCourante = 1;
            }

            $depart = ($pageCourante-1)*$topicsParPage;
            $this->managerForum->depart = $depart;
            $this->managerForum->topicsParPage = $topicsParPage;

            $pagination['topicsTotaux'] = $topicsTotaux;
            $pagination['pageCourante'] = $pageCourante;


            $topics = $this->managerForum->getTopics();
            $categorie = $this->managerForum->getCategorie();
            if(!empty($topics)){
            foreach($topics as $topic){
                $lastCommentaire = $this->managerForum->getLastCommentaireTopic($topic['id']);
                $lastCommentaires[$topic['id']] = $lastCommentaire;

            }}else{
                $lastCommentaires = null;
            }
            
            $forumCategorie = 'plugins/forum/src/view/user/categorieView.php';
            $forumCategorie = $this->controllerBase->tamponView($forumCategorie, ['topics' =>$topics, 'lastCommentaires' =>$lastCommentaires, 'categorie' =>$categorie, 'pagination' =>$pagination]);
            $this->controllerBase->afficheView([$forumCategorie],'categorieView');
        }
    }
    
    /**
     * afficheCreateTopic
     *
     *  Permet d'afficher la création d'un topic
     * 
     * @param  int $idCategorie
     * @return void
     */
    public function afficheCreateTopic($idCategorie){
        if(isset($_SESSION['idUser'])){
            $createTopic = 'plugins/forum/src/view/user/createTopicView.php';
            $createTopic = $this->controllerBase->tamponView($createTopic,['idCategorie' => $idCategorie]);
            $this->controllerBase->afficheView([$createTopic],'createTopicView');
        }
    }
    
    /**
     * createTopic
     *
     *  Permet d'ajouter le topic créer dans la catégorie assigner
     * 
     * @param  int $idCategorie
     * @return void
     */
    public function createTopic($idCategorie){
        if(isset($_SESSION['idUser'])){
            
            if(!empty($_POST['nomTopic'])&& !empty($_POST['messageTopic'])){
                    $this->managerForum->idCategorie = $idCategorie;
                    $categorieExist = $this->managerForum->categorieExist();
                    if(empty($categorieExist)){
                        header('Location:index.php?forum=afficheCategories');
                    }
                    $this->managerForum->nomTopic = htmlspecialchars($_POST['nomTopic']);
                    $this->managerForum->auteurTopic = $_SESSION['pseudo'];
                    $this->managerForum->messageTopic = htmlspecialchars($_POST['messageTopic']);
                    
                    
                    $addTopic = $this->managerForum->addTopic();
                    
        
                    $idTopic = $this->managerForum->getIdTopicByNom();
                    
                    if($addTopic){
                        header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic['id'].'&page=1');
                    }
                }
                else{
                    header('Location:index.php?forum=afficheCreateTopic');
            }
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
    
    /**
     * createCommentaire
     *
     *  Permet d'ajouter un commentaire à son topic 
     * 
     * @param  int $idTopic
     * @return void
     */
    public function createCommentaire($idTopic){
        if(isset($_SESSION['idUser'])){
            if(!empty($_POST['commentaire']) && !preg_match("#[]#", $_POST['commentaire'])){
                $this->managerForum->idTopic = $idTopic;
                $verifExist = $this->managerForum->topicExist();
                if($verifExist){
                    $this->managerForum->auteurCommentaire = $_SESSION['pseudo'];
                    $this->managerForum->messageCommentaire =htmlspecialchars($_POST['commentaire']);
                    
                    $addCommentaire = $this->managerForum->addCommentaire();
                    
                    if($addCommentaire){
                        header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic.'&page=1');
                    }
                }
                
            }
            else{
                header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic.'&page=1');
            }
            
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
    
    /**
     * afficheModifTopic
     *
     *  Permet d'afficher la modification de topic
     * 
     * @param  int $idTopic
     * @return void
     */
    public function afficheModifTopic($idTopic){
        if(isset($_SESSION['idUser'])){
            $this->managerForum->idTopic = $idTopic;
            $topic = $this->managerForum->getTopic();
            if($topic['auteur'] = $_SESSION['pseudo']){
                $modifTopic = 'plugins/forum/src/view/user/modifTopicView.php';
                $modifTopic = $this->controllerBase->tamponView($modifTopic,['topic' => $topic]);
                $this->controllerBase->afficheView([$modifTopic],'modifTopicView');
            }
            else{
                header('Location:index.php?forum=afficheTopic&idTopic='.$topic['id'].'&page=1');
            }
        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }
    
    /**
     * modifTopic
     *
     *  Permet de modifier un topic
     * 
     * @param  int $idTopic
     * @return void
     */
    public function modifTopic($idTopic){
        if(isset($_SESSION['idUser'])){
            if(!empty($_POST['nomTopic'])&& !empty($_POST['messageTopic'])){
                if(!preg_match("#[<>1-9]#", $_POST['nomTopic'])&& !preg_match("#[<>1-9]#", $_POST['messageTopic'])){
                    $this->managerForum->idTopic = $idTopic;
                    $this->managerForum->nomTopic = $_POST['nomTopic'];
                    $this->managerForum->messageTopic = $_POST['messageTopic'];
        
                    $modifTopic = $this->managerForum->modifTopic();
        
                    if($modifTopic){
                        header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic.'&page=1');
                    }
                }
            }
            else{
                header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic.'&page=1');
            }

        }
        else{
            throw new Exception("Vous devez être connecter pour accéder à cette page!");
        }
    }

}