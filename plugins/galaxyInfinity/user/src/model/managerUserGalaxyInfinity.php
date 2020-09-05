<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGalaxyInfinity extends ManagerBDD
{
    public function getUserByPseudo(){
        
        $sql = 'SELECT * FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql,[$this->pseudo]);
        $result = $result->fetch();
        $this->idUser = $result['id'];
       
    }

    public function getPlanetesDispo(){
        $sql= 'SELECT * FROM planete WHERE situation = 0';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function attributPlaneteUser(){
        $sql = 'UPDATE planete SET situation = 1, user_id = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idUser, $this->idPlanete]);
        return $result;
    }

    public function getBatBaseUser(){
        $sql = 'SELECT * FROM batiment';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getTechnoBaseUser(){
        $sql = 'SELECT * FROM technologie';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    public function getCraftBaseUser(){
        $sql = 'SELECT * FROM craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    public function getItemsBaseUser(){
        $sql = 'SELECT * FROM items';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getBatStartPlaneteUser(){
        $sql = 'SELECT * FROM bat_start_planete';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function setBatBaseUser(){
        $sql = 'INSERT INTO batiment_planete(niveau,planete_id,batiment_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idBat]);
        return $result;
    }
    
    public function setTechnoBaseUser(){
        $sql = 'INSERT INTO technologie_planete(niveau,planete_id,technologie_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idTechno]);
        return $result;
    }
    
    public function setCraftBaseUser(){
        $sql = 'INSERT INTO craft_planete(nombre_craft,planete_id,craft_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idCraft]);
        return $result;
    }
    public function setItemsBaseUser(){
        $sql = 'INSERT INTO items_planete(nombre_items,planete_id,items_id) VALUES(0,?,?)';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idItems]);
        return $result;
    }

    public function setBatStartPlaneteUser(){
        $sql = 'UPDATE batiment_planete SET niveau = ? WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->niveau,$this->idPlanete,$this->idBat]);
        return $result;
    }

    public function getPlaneteUser(){
        $sql = 'SELECT * FROM planete WHERE user_id = ?';
        $result = $this->createQuery($sql,[$this->idUser]);
        return $result->fetch();
    }

    public function preRequisBaseX(){
        $sql = 'SELECT * FROM '.$this->pRBaseTable;
        $result = $this->createQuery($sql);
       
        return $result->fetchAll();
    }


    public function getPreRequisX(){
        
        $sql = 'SELECT  t1.id AS id, t1.'.$this->prX.' AS pRTypeX, t1.batiment_id_requis AS batiment_id_requis, t1.niveau_id_batiment AS niveau_id_batiment, t1.technologie_id_requis AS technologie_id_requis, t1.niveau_id_technologie AS niveau_id_technologie, t2.nom AS nom_batiment, t3.nom AS nom_technologie
        FROM '.$this->pRTable.' t1
        LEFT JOIN batiment t2 ON t1.batiment_id_requis = t2.id
        LEFT JOIN technologie t3 ON t1.technologie_id_requis = t3.id';
       

        $result = $this->createQuery($sql);
       
        return $result->fetchAll();
    }

}