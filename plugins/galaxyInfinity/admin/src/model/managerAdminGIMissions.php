<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIMissions extends ManagerBDD
{    

    public function getMissionBaseById(){
        $sql ='SELECT * FROM missions WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idMission]);
        $result = $result->fetch();
 
        $this->nomMission = $result['nom'];
        $this->descrMission = $result['description'];
        $this->typeMission = $result['type'];
        $this->genreMission = $result['genre'];
        $this->niveauMission = $result['niveau'];
    }

    public function verifMissionExist(){
    
        $sql = 'SELECT id FROM missions WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomMission]);
        return $result->rowCount();
        
    }

    public function insertMissionBase(){
    
    $sql ='INSERT INTO missions(nom,description,type,genre,niveau) VALUES(?,?,?,?,?)';
    return $this->createQuery($sql,[$this->nomMission,$this->descrMission,$this->typeMission,$this->genreMission,$this->niveauMission]);
    
    }

    public function getMissionsBaseAdmin(){

        $sql ='SELECT * FROM missions ORDER BY id DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
        
    }
    public function supprMissionBase(){

        $sql='DELETE FROM missions WHERE id = ?';
        return $this->createQuery($sql,[$this->idMission]);

    }

    public function modifMissionBase(){

        $sql='UPDATE missions SET nom = ?, description = ?, type = ?, genre = ?, niveau = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomMission,$this->descrMission,$this->typeMission,$this->genreMission,$this->niveauMission,$this->idMission]);
        
    }

    public function getRecompenseMissionsBaseAdmin(){
        $sql = 'SELECT * FROM recompenses_missions
        LEFT JOIN missions as missionsId ON missionsId.id = recompenses_missions.id_mission 
        LEFT JOIN items as itemsId ON itemsId.id = recompenses_missions.id_items
        LEFT JOIN ressource as ressourceId ON ressourceId.id = recompenses_missions.id_ressource
        LEFT JOIN craft as craftId ON craftId.id = recompenses_missions.id_craft
        
        WHERE id_mission';

        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getAllItemsAdmin(){
        $sql= "SELECT * FROM items";
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    public function getAllRessouceAdmin(){
        $sql= "SELECT * FROM ressource";
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    public function getAllCraftAdmin(){
        $sql= "SELECT * FROM craft";
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifRecompenseMissionExist(){
        $sql = 'SELECT id_ressource, id_items, id_craft FROM recompenses_missions WHERE id_mission = ? AND id_ressource =? OR id_items =? OR id_craft = ?';
        $result = $this->createQuery($sql,[$this->idMission,$this->idRessource, $this->idItem, $this->idCraft]);
        return $result->rowCount();
    }

    public function createRecompenseMissionBase(){
        $sql = 'INSERT INTO recompenses_missions(id_mission,id_ressource,nombre_ressource,id_items,nombre_items,id_craft,nombre_craft) VALUES(?,?,?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idMission,$this->idRessource,$this->nombreRessource,$this->idItem,$this->nombreItem,$this->idCraft, $this->nombreCraft]);
        
    }

    public function verifRecompenseMissionExistById(){
        $sql = 'SELECT id FROM recompenses_missions WHERE id= ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function supprRecompenseMissionBase(){
        $sql = 'DELETE FROM recompenses_missions WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
       
    }

    public function modifRecompenseMissionBase(){
        
        $sql = 'UPDATE recompenses_missions SET id_mission = ?, id_ressource = ?,nombre_ressource = ?,id_items = ?, nombre_items = ?, id_craft = ?, nombre_craft = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idMission, $this->idRessource,$this->nombreRessouce,$this->idItem,$this->nombreItem,$this->idCraft,$this->nombreCraft,$this->idLigne]);
    }

}