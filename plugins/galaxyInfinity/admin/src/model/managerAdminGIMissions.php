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
}