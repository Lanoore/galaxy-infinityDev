<?php

namespace App\plugins\forum\src\controller;

/* Ajoutez ici tout les manager (dossier model du plugin) */
use App\plugins\forum\src\model\ManagerForum;

/* Ajoutez ici tout les controller (dossier controller du plugin ou extérieur si nécessire) */

use App\config\themes\controller\controllerBase;

class ControllerForum{
    /* Mettre ici les variables privates pour les manager */
    private $managerForum;

    /* Mettre ici les variables privates pour les controller */
    private $controllerBase;


    public function __construct(){
        $this->managerForum = new ManagerForum();

        $this->controllerBase = new ControllerBase();
    }

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


            $topicForum = '../plugins/forum/src/view/user/topicView.php';
            $topicForum = $this->controllerBase->tamponView($topicForum, ['topic' => $topic, 'commentaires' => $commentaires,'pagination' =>$pagination]);
            $this->controllerBase->afficheView([$topicForum]);
        }
    }



    public function afficheCategories(){
        if(isset($_SESSION['idUser'])){
            $categories = $this->managerForum->getCategories();
            
            foreach ($categories as $categorie) {

                $lastTopic = $this->managerForum->getLastTopicCategorie($categorie['id']);
                $lastTopics[$categorie['id']] = $lastTopic;

            }
            
            $forumCategories = '../plugins/forum/src/view/user/categoriesView.php';
            $forumCategories = $this->controllerBase->tamponView($forumCategories, ['categories' => $categories, 'lastTopics' => $lastTopics]);
            $this->controllerBase->afficheView([$forumCategories]);
        }

    }

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

            foreach($topics as $topic){
                $lastCommentaire = $this->managerForum->getLastCommentaireTopic($topic['id']);
                $lastCommentaires[$topic['id']] = $lastCommentaire;

            }
            
            $forumCategorie = '../plugins/forum/src/view/user/categorieView.php';
            $forumCategorie = $this->controllerBase->tamponView($forumCategorie, ['topics' =>$topics, 'lastCommentaires' =>$lastCommentaires, 'categorie' =>$categorie, 'pagination' =>$pagination]);
            $this->controllerBase->afficheView([$forumCategorie]);
        }
    }

    public function afficheCreateTopic($idCategorie){
        if(isset($_SESSION['idUser'])){
            

            $createTopic = '../plugins/forum/src/view/user/createTopicView.php';
            $createTopic = $this->controllerBase->tamponView($createTopic,['idCategorie' => $idCategorie]);
            $this->controllerBase->afficheView([$createTopic]);
        }
    }

    public function createTopic($idCategorie){
        if(isset($_SESSION['idUser'])){
            if(!empty($_POST['nomTopic'])&& !empty($_POST['messageTopic'])){
                if(!preg_match("#[<>1-9]#", $_POST['nomTopic'])){

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
                    echo('erreur');
                }
            }
        }
    }

    public function createCommentaire($idTopic){
        if(isset($_SESSION['idUser'])){
            if(!empty($_POST['commentaire'])){
                $this->managerForum->auteurCommentaire = $_SESSION['pseudo'];
                $this->managerForum->messageCommentaire =htmlspecialchars($_POST['commentaire']);
                $this->managerForum->idTopic = $idTopic;
                $addCommentaire = $this->managerForum->addCommentaire();
    
                
                if($addCommentaire){
                    header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic.'&page=1');
                }
            }
            
        }
    }

    public function afficheModifTopic($idTopic){
        if(isset($_SESSION['idUser'])){
            $this->managerForum->idTopic = $idTopic;
            $topic = $this->managerForum->getTopic();
            if($topic['auteur'] = $_SESSION['pseudo']){
                $modifTopic = '../plugins/forum/src/view/user/modifTopicView.php';
                $modifTopic = $this->controllerBase->tamponView($modifTopic,['topic' => $topic]);
                $this->controllerBase->afficheView([$modifTopic]);
            }
            else{
                header('Location:index.php?forum=afficheTopic&idTopic='.$topic['id'].'&page=1');
            }
        }
    }

    public function modifTopic($idTopic){
        if(isset($_SESSION['idUser'])){
            $this->managerForum->idTopic = $idTopic;
            $this->managerForum->nomTopic = $_POST['nomTopic'];
            $this->managerForum->messageTopic = $_POST['messageTopic'];

            $modifTopic = $this->managerForum->modifTopic();

            if($modifTopic){
                header('Location:index.php?forum=afficheTopic&idTopic='.$idTopic.'&page=1');
            }

        }
    }

}