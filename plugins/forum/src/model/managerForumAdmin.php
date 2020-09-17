<?php

namespace App\plugins\forum\src\model;

use App\config\ManagerBDD;

class ManagerForumAdmin extends ManagerBDD
{    
    /**
     * getCategories
     *
     *  Récupère les catégories
     * 
     * @return array
     */
    public function getCategories(){
        $sql = 'SELECT id, nom FROM categorie';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getTopics
     *
     *  Récupère les topics
     * 
     * @return array
     */
    public function getTopics(){
        $sql = 'SELECT topics.id,topics.nom, topics.auteur,topics.message,topics.dateCreation,topics.dateModif,topics.idCategorie,categorie.nom nomCategorie  FROM topics INNER JOIN categorie ON topics.idCategorie = categorie.id ORDER BY dateCreation DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getCommentaires
     *
     *  Récupère les commentaires
     * 
     * @return array
     */
    public function getCommentaires(){
        $sql = 'SELECT commentaires.id,commentaires.auteur,commentaires.message,commentaires.dateCreation,commentaires.dateModif,commentaires.idTopic,topics.nom nomTopic FROM commentaires INNER JOIN topics ON commentaires.idTopic = topics.id ORDER BY dateCreation DESC';
        $result = $this->createQuery($sql);
        $data = $result->fetchAll();

        return $data;
    }
    
    /**
     * createCategorie
     *
     * Ajoute une catégorie en bdd
     * 
     * @return void
     */
    public function createCategorie(){
        $sql = 'INSERT INTO categorie(nom) VALUES (?)';
        $result = $this->createQuery($sql, [$this->nomCategorie]);

        return $result;
    }
    
    /**
     * supprCategorie
     *
     *  Supprime une catégorie de la bdd
     * 
     * @return void
     */
    public function supprCategorie(){
        $sql = 'DELETE FROM categorie WHERE id = ?';
        $result  = $this->createQuery($sql,[$this->idCategorie]);

        return $result;
    }
    
    /**
     * modifCategorie
     *
     * Modifie la catégorie cible dans la bdd
     * 
     * @return void
     */
    public function modifCategorie(){
        $sql = 'UPDATE categorie SET nom = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomCategorie, $this->idCategorie]);

        return $result;
    }
    
    /**
     * supprTopic
     *
     * Supprime un topic
     * 
     * @return void
     */
    public function supprTopic(){
        $sql = 'DELETE FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);

        return $result;
    }
    
    /**
     * moveTopic
     *
     *  Déplace un topic 
     * 
     * @return void
     */
    public function moveTopic(){
        $sql = 'UPDATE topics SET idCategorie = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCategorie,$this->idTopic]);
        return $result;
    }
    
    /**
     * supprCommentaire
     *
     *  Supprime le commentaire
     * 
     * @return void
     */
    public function supprCommentaire(){
        $sql = 'DELETE FROM commentaires WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCommentaire]);

        return $result;
    }

    
    /**
     * categorieExist
     *
     *  Vérifie si la catégorie existe 
     * 
     * @return void
     */
    public function categorieExist(){
        $sql = 'SELECT id FROM categorie WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCategorie]);
        $result = $result->rowCount();
        return $result;

    }
    
    /**
     * topicExist
     *
     *  Vérifie si un topic existe
     * 
     * @return void
     */
    public function topicExist(){
        $sql = 'SELECT id FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);
        $result = $result->rowCount();
        return $result;

    }
    
    /**
     * commentaireExist
     *
     *  Vérifie si un commentaire existe
     * 
     * @return void
     */
    public function commentaireExist(){
        $sql = 'SELECT id FROM commentaires WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCommentaire]);
        $result = $result->rowCount();
        return $result;

    }
}