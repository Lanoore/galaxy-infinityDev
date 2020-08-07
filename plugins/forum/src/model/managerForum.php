<?php

namespace App\plugins\forum\src\model;

use App\config\ManagerBDD;

class ManagerForum extends ManagerBDD
{

    public function getCategorie(){
        $sql ='SELECT id,nom FROM categorie WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCategorie]);
        return $result->fetch();
    }

    public function getCategories(){
        $sql ='SELECT id, nom FROM categorie';
        $result = $this->createQuery($sql);
        $result = $result->fetchAll();
        return $result;
    }

    public function getTopics(){
        $sql = 'SELECT id, nom,auteur,message,DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation,DATE_FORMAT(dateModif,\'%d/%m/%Y %Hh%i\')as dateModif FROM topics WHERE idCategorie = ? ORDER BY dateModif DESC LIMIT '.$this->depart.','.$this->topicsParPage;
        $result = $this->createQuery($sql,[$this->idCategorie]);
        $result = $result->fetchAll();
        return $result;
    }

    public function getTopic(){
        $sql = 'SELECT id, nom,auteur,message,DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation,DATE_FORMAT(dateModif,\'%d/%m/%Y %Hh%i\')as dateModif FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);
        $result = $result->fetch();
        return $result;
    }

    public function getCommentaires(){
        $sql = 'SELECT id, auteur, message,DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation,DATE_FORMAT(dateModif,\'%d/%m/%Y %Hh%i\')as dateModif FROM commentaires WHERE idTopic = ? ORDER BY dateCreation DESC LIMIT '.$this->depart.','.$this->commentairesParPage;
        $result = $this->createQuery($sql,[$this->idTopic]);
        $result = $result->fetchAll();
        return $result;
    }

    public function addTopic(){

        $sql = 'INSERT INTO topics(nom,auteur,message,dateCreation,dateModif,idCategorie) VALUES(?,?,?,NOW(),NOW(),?)';

        $result = $this->createQuery($sql,[$this->nomTopic,$this->auteurTopic,$this->messageTopic,$this->idCategorie]);
        return $result;
    }

    public function addCommentaire(){
        $sql ='INSERT INTO commentaires(auteur,message,dateCreation,dateModif,idTopic)VALUES(?,?,NOW(),NOW(),?)';
        $result = $this->createQuery($sql,[$this->auteurCommentaire,$this->messageCommentaire,$this->idTopic]);
        return $result;
    }

    public function modifTopic(){
        $sql ='UPDATE topics SET nom = ?, message = ?,dateModif = NOW() WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomTopic,$this->messageTopic,$this->idTopic]);
        return $result;
    }

    public function modifCommentaire(){
        $sql ='UPDATE commentaires SET message = ?,dateModif = NOW() WHERE idTopic = ?';
        $result = $this->createQuery($sql,[$this->messageCommentaire,$this->idTopic]);
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

    public function getLastTopicCategorie($idCategorie){
        $sql = 'SELECT nom FROM topics WHERE idCategorie = ? ORDER BY dateModif DESC LIMIT 1';
        $result = $this->createQuery($sql,[$idCategorie]);
        return $result->fetch();
    }

    public function getLastCommentaireTopic($idTopic){
        $sql = 'SELECT DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation, auteur FROM commentaires WHERE idTopic = ? ORDER BY dateCreation DESC LIMIT 1';
        $result = $this->createQuery($sql,[$idTopic]);
        return $result->fetch();
    }

    public function getNbTopics(){
        $sql ='SELECT id FROM topics WHERE idCategorie = ?';
        $result = $this->createQuery($sql,[$this->idCategorie]);
        $this->nbTopics = $result->rowCount();
    }

    public function getNbCommentaires(){
        $sql = 'SELECT id FROM commentaires WHERE idTopic = ?';
        $result = $this->createQuery($sql, [$this->idTopic]);
        $this->nbCommentaires =  $result->rowCount();
    }


    public function getIdTopicByNom(){
        $sql = 'SELECT id FROM topics WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomTopic]);
        return $result->fetch();
        
    }
}