<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGalaxyInfinity extends ManagerBDD
{    
    /**
     * getUserByPseudo
     *
     * Récupère les informations de l'utilisateur via son pseudo
     * 
     * @return void
     */
    public function getUserByPseudo(){
        
        $sql = 'SELECT * FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql,[$this->pseudo]);
        $result = $result->fetch();
        $this->idUser = $result['id'];
       
    }
        
    /**
     * verifPlanetesDispo
     *
     *  Verifie si une planete est disponible
     * 
     * @return int
     */
    public function verifPlanetesDispo(){
        $sql ='SELECT * FROM planete WHERE situation = 0';
        $result = $this->createQuery($sql);
        return $result->rowCount();
    }

    /**
     * createSystemePlanete
     * 
     * Créer une planete
     *
     * @return bool
     */
    public function createSystemePlanete(){
        $sql = 'INSERT INTO planete(systeme,position,situation)VALUES(?,?,0)';
        return $this->createQuery($sql,[$this->numeroSysteme,$this->numeroPlanete]);
        
    }

    public function getLastSysteme(){
        $sql ='SELECT systeme FROM planete ORDER BY id DESC LIMIT 1';
        $result = $this->createQuery($sql);
        return $result->fetch();
    }

    /**
     * getPlanetesDispo
     * 
     * Récupère les planètes disponible
     *
     * @return array
     */
    public function getPlanetesDispo(){
        $sql= 'SELECT * FROM planete WHERE situation = 0';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * attributPlaneteUser
     * 
     * attribut la planete a l'utilisateur
     *
     * @return bool
     */
    public function attributPlaneteUser(){
        $sql = 'UPDATE planete SET situation = 1, user_id = ? , last_activite = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idUser, $this->lastActivite,$this->idPlanete]);
        return $result;
    }

    public function attributPlaneteMere(){
        $sql ='INSERT INTO user_planeteMere(idUser, idPlaneteMere) VALUES(?,?)';
        $result = $this->createQuery($sql,[$this->idUser, $this->idPlanete]);
        return $result;

    }

    public function getPlaneteMereUser(){
        $sql = 'SELECT * FROM user_planeteMere WHERE idUser = ?';
        $result = $this->createQuery($sql,[$this->idUser]);
        return $result->fetch(); 
    }
    
    /**
     * getBatBaseUser
     * 
     * Récupère les batiments de base
     *
     * @return array
     */
    public function getBatBaseUser(){
        $sql = 'SELECT * FROM batiment';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getTechnoBaseUser
     *
     * Récupère les technologies de base
     * 
     * @return array
     */
    public function getTechnoBaseUser(){
        $sql = 'SELECT * FROM technologie';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }    
    /**
     * getCraftBaseUser
     * 
     * Récupère les craft de base
     *
     * @return array
     */
    public function getCraftBaseUser(){
        $sql = 'SELECT * FROM craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }    
    /**
     * getItemsBaseUser
     * 
     * Récupère les items de base
     *
     * @return array
     */
    public function getItemsBaseUser(){
        $sql = 'SELECT * FROM items';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getRessourceBaseUser
     * 
     * Récupère les ressources de base 
     *
     * @return array
     */
    public function getRessourceBaseUser(){
        $sql = 'SELECT * FROM ressource';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getPopBaseUser(){
        $sql = 'SELECT * FROM population';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getBatStartPlaneteUser
     * 
     * Récupère les batiments au start
     *
     * @return array
     */
    public function getBatStartPlaneteUser(){
        $sql = 'SELECT * FROM bat_start_planete';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    
    /**
     * setBatBaseUser
     *
     * Ajout le batiment dans la planete
     * 
     * @return bool
     */
    public function setBatBaseUser(){
        $sql = 'INSERT INTO batiment_planete(niveau,planete_id,batiment_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idBat]);
        return $result;
    }
        
    /**
     * setTechnoBaseUser
     * 
     * Ajout la technologie dans la planete
     *
     * @return bool
     */
    public function setTechnoBaseUser(){
        $sql = 'INSERT INTO technologie_planete(niveau,planete_id,technologie_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idTechno]);
        return $result;
    }
        
    /**
     * setCraftBaseUser
     * 
     * Ajout le craft dans la planete
     *
     * @return bool
     */
    public function setCraftBaseUser(){
        $sql = 'INSERT INTO craft_planete(nombre_craft,planete_id,craft_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idCraft]);
        return $result;
    }    
    /**
     * setItemsBaseUser
     * 
     * Ajout l'item dans la planete
     *
     * @return bool
     */
    public function setItemsBaseUser(){
        $sql = 'INSERT INTO items_planete(nombre_items,planete_id,items_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idItems]);
        return $result;
    }
    
    /**
     * setRessourceBaseUser
     * 
     * Ajout des ressources dans la planete
     *
     * @return bool
     */
    public function setRessourceBaseUser(){
        $sql = 'INSERT INTO ressource_planete(ressource_id,planete_id,nombre_ressource) VALUES (?,?,0)';
        $result = $this->createQuery($sql,[$this->idRessource,$this->idPlanete]);
        return $result;

    }

    public function setPopBaseUser(){
        $sql = 'INSERT INTO population_planete(nombre_pop,planete_id,pop_id) VALUES (0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idPop]);
        return $result;
    }


    /**
     * setBatStartPlaneteUser
     * 
     * Set les batiments de base dans la planete
     *
     * @return bool
     */
    public function setBatStartPlaneteUser(){
        $sql = 'UPDATE batiment_planete SET niveau = ? WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->niveau,$this->idPlanete,$this->idBat]);
        return $result;
    }

    
    
    /**
     * getPlaneteUser
     *
     * Récupère la planete par rapport a l'id du joueur
     * 
     * @return array
     */
    public function getPlaneteUser(){
        $sql = 'SELECT * FROM planete WHERE user_id = ?';
        $result = $this->createQuery($sql,[$this->idUser]);
        return $result->fetch();
    }
    
    /**
     * preRequisBaseX
     * 
     * Récupère les pré requis de base sur la table demander (batiment ou technologie ou craft)
     *
     * @return array
     */
    public function preRequisBaseX(){
        $sql = 'SELECT * FROM '.$this->pRBaseTable;
        $result = $this->createQuery($sql);
       
        return $result->fetchAll();
    }

    
    /**
     * getPreRequisX
     * 
     * Récupère les pré-requis associer a la table demander (batiment/technologie/craft) pour chaque pré-requis créer une ligne
     *
     * @return void
     */
    public function getPreRequisX(){
        
        $sql = 'SELECT  t1.id AS id, t1.'.$this->prX.' AS pRTypeX, t1.batiment_id_requis AS batiment_id_requis, t1.niveau_id_batiment AS niveau_id_batiment, t1.technologie_id_requis AS technologie_id_requis, t1.niveau_id_technologie AS niveau_id_technologie, t2.nom AS nom_batiment, t3.nom AS nom_technologie
        FROM '.$this->pRTable.' t1
        LEFT JOIN batiment t2 ON t1.batiment_id_requis = t2.id
        LEFT JOIN technologie t3 ON t1.technologie_id_requis = t3.id';
       

        $result = $this->createQuery($sql);
       
        return $result->fetchAll();
    }


    public function updateNomPlaneteMereJoueur(){
        $sql ='UPDATE planete  SET nomPlanete = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomPlaneteMere, $this->idPlanete]);
        return $result;
    }


    public function getGuildePlayer(){
        $sql = 'SELECT * FROM user WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idUser]);
        return $result->fetch();
    }

    
}