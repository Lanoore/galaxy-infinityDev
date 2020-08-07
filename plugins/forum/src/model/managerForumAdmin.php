<?php

namespace App\plugins\forum\src\model;

use App\config\ManagerBDD;

class ManagerForumAdmin extends ManagerBDD
{
    public function getCategories(){
        $sql = 'SELECT id, nom FROM categorie';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getTopics(){
        $sql = 'SELECT topics.id,topics.nom, topics.auteur,topics.message,topics.dateCreation,topics.dateModif,topics.idCategorie,categorie.nom nomCategorie  FROM topics INNER JOIN categorie ON topics.idCategorie = categorie.id ORDER BY dateCreation DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();


    }

    public function getCommentaires(){
        $sql = 'SELECT commentaires.id,commentaires.auteur,commentaires.message,commentaires.dateCreation,commentaires.dateModif,commentaires.idTopic,topics.nom nomTopic FROM commentaires INNER JOIN topics ON commentaires.idTopic = topics.id ORDER BY dateCreation DESC';
        $result = $this->createQuery($sql);
        $data = $result->fetchAll();

        return $data;
    }

    public function createCategorie(){
        $sql = 'INSERT INTO categorie(nom) VALUES (?)';
        $result = $this->createQuery($sql, [$this->nomCategorie]);

        return $result;
    }

    public function supprCategorie(){
        $sql = 'DELETE FROM categorie WHERE id = ?';
        $result  = $this->createQuery($sql,[$this->idCategorie]);

        return $result;
    }

    public function modifCategorie(){
        $sql = 'UPDATE categorie SET nom = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomCategorie, $this->idCategorie]);

        return $result;
    }

    public function supprTopic(){
        $sql = 'DELETE FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);

        return $result;
    }

    public function moveTopic(){
        $sql = 'UPDATE topics SET idCategorie = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCategorie,$this->idTopic]);
        return $result;
    }

    public function supprCommentaire(){
        $sql = 'DELETE FROM commentaires WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCommentaire]);

        return $result;
    }


    public function categorieExist(){
        $sql = 'SELECT id FROM categorie WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCategorie]);
        $result = $result->rowCount();
        return $result;

    }

    public function topicExist(){
        $sql = 'SELECT id FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);
        $result = $result->rowCount();
        return $result;

    }

    public function commentaireExist(){
        $sql = 'SELECT id FROM commentaires WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCommentaire]);
        $result = $result->rowCount();
        return $result;

    }
}