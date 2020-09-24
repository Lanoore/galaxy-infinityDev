<?php

namespace App\plugins\forum\src\model;

use App\config\ManagerBDD;

class ManagerForum extends ManagerBDD
{
    
    /**
     * getCategorie
     *
     *  Récupère le nom d'une catégorie par rapport a son id
     * 
     * @return array
     */
    public function getCategorie(){
        $sql ='SELECT id,nom FROM categorie WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCategorie]);
        return $result->fetch();
    }
    
    /**
     * getCategories
     *
     *  Récupère toutes les catégories
     * 
     * @return array
     */
    public function getCategories(){
        $sql ='SELECT id, nom FROM categorie';
        $result = $this->createQuery($sql);
        return $result = $result->fetchAll();
        
    }
    
    /**
     * getTopics
     *
     *  Récupère les topics associer à la catégorie
     * 
     * @return array
     */
    public function getTopics(){
        $sql = 'SELECT id, nom,auteur,message,DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation,DATE_FORMAT(dateModif,\'%d/%m/%Y %Hh%i\')as dateModif FROM topics WHERE idCategorie = ? ORDER BY dateModif DESC LIMIT '.$this->depart.','.$this->topicsParPage;
        $result = $this->createQuery($sql,[$this->idCategorie]);
        return $result = $result->fetchAll();

    }
    
    /**
     * getTopic
     *
     *  Récupère un topic par rapport a son id
     * 
     * @return array
     */
    public function getTopic(){
        $sql = 'SELECT id, nom,auteur,message,DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation,DATE_FORMAT(dateModif,\'%d/%m/%Y %Hh%i\')as dateModif FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);
        return $result = $result->fetch();

    }
    
    /**
     * getCommentaires
     *
     *  Récupère les commentaires associer au topic cible
     * 
     * @return array
     */
    public function getCommentaires(){
        $sql = 'SELECT id, auteur, message,DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation,DATE_FORMAT(dateModif,\'%d/%m/%Y %Hh%i\')as dateModif FROM commentaires WHERE idTopic = ? ORDER BY dateCreation DESC LIMIT '.$this->depart.','.$this->commentairesParPage;
        $result = $this->createQuery($sql,[$this->idTopic]);
        return $result = $result->fetchAll();

    }
    
    /**
     * addTopic
     *
     *  Ajout le topic dans la bdd
     * 
     * @return bool
     */
    public function addTopic(){

        $sql = 'INSERT INTO topics(nom,auteur,message,dateCreation,dateModif,idCategorie) VALUES(?,?,?,NOW(),NOW(),?)';

        $result = $this->createQuery($sql,[$this->nomTopic,$this->auteurTopic,$this->messageTopic,$this->idCategorie]);
        return $result;
    }
    
    /**
     * addCommentaire
     *
     *  Ajoute le commentaire dans la bdd
     * 
     * @return bool
     */
    public function addCommentaire(){
        $sql ='INSERT INTO commentaires(auteur,message,dateCreation,dateModif,idTopic)VALUES(?,?,NOW(),NOW(),?)';
        $result = $this->createQuery($sql,[$this->auteurCommentaire,$this->messageCommentaire,$this->idTopic]);
        return $result;
    }
    
    /**
     * modifTopic
     *
     *  Modifi le topic en bdd
     * 
     * @return bool
     */
    public function modifTopic(){
        $sql ='UPDATE topics SET nom = ?, message = ?,dateModif = NOW() WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomTopic,$this->messageTopic,$this->idTopic]);
        return $result;
    }
    
    /**
     * modifCommentaire
     *  
     * Modifi le commentaire en bdd
     * 
     * @return bool
     */
    public function modifCommentaire(){
        $sql ='UPDATE commentaires SET message = ?,dateModif = NOW() WHERE idTopic = ?';
        $result = $this->createQuery($sql,[$this->messageCommentaire,$this->idTopic]);
        return $result;
    }
    
    /**
     * categorieExist
     * 
     *  Verifie si une catégorie existe en retourant le nombre de ligne ayant pour id celui envoyer 
     * 
     * @return int
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
     * Verifie si un topic existe en retourant le nombre de ligne ayant pour id celui envoyer 
     *
     * @return int
     */
    public function topicExist(){
        $sql = 'SELECT id FROM topics WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idTopic]);
        $result = $result->rowCount();
        return $result;

    }
    
    /**
     * getLastTopicCategorie
     *
     *  Récupère le dernière topic de la catégorie
     * 
     * @param  int $idCategorie
     * @return array
     */
    public function getLastTopicCategorie($idCategorie){
        $sql = 'SELECT nom FROM topics WHERE idCategorie = ? ORDER BY dateModif DESC LIMIT 1';
        $result = $this->createQuery($sql,[$idCategorie]);
        return $result->fetch();
    }
    
    /**
     * getLastCommentaireTopic
     *
     *  Récupère le dernier commentaire du topic
     * 
     * @param  int $idTopic
     * @return array
     */
    public function getLastCommentaireTopic($idTopic){
        $sql = 'SELECT DATE_FORMAT(dateCreation,\'%d/%m/%Y %Hh%i\') AS dateCreation, auteur FROM commentaires WHERE idTopic = ? ORDER BY dateCreation DESC LIMIT 1';
        $result = $this->createQuery($sql,[$idTopic]);
        return $result->fetch();
    }
    
    /**
     * getNbTopics
     * 
     *  Récupère le nombres de topics dans une catégorie
     *
     * @return void
     */
    public function getNbTopics(){
        $sql ='SELECT id FROM topics WHERE idCategorie = ?';
        $result = $this->createQuery($sql,[$this->idCategorie]);
        $this->nbTopics = $result->rowCount();
    }
    
    /**
     * getNbCommentaires
     *
     *  Récupère le nombres de commentaire dans un topic
     * 
     * @return void
     */
    public function getNbCommentaires(){
        $sql = 'SELECT id FROM commentaires WHERE idTopic = ?';
        $result = $this->createQuery($sql, [$this->idTopic]);
        $this->nbCommentaires =  $result->rowCount();
    }

    
    /**
     * getIdTopicByNom
     * 
     * Récupère l'id d'un topic par rapport a son nom
     *
     * @return array
     */
    public function getIdTopicByNom(){
        $sql = 'SELECT id FROM topics WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomTopic]);
        return $result->fetch();
        
    }
}