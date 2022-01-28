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
        LEFT JOIN craft as craftId ON craftId.id = recompenses_missions.id_craft';

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
    public function getAllBatAdmin(){
        $sql = 'SELECT * FROM batiment';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    public function getAllPopAdmin(){
        $sql = 'SELECT * FROM population';
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

    public function getPreRequisMissionsBaseAdmin(){
        $sql = 'SELECT * FROM pre_requis_missions
                LEFT JOIN missions as missionsId ON missionsId.id = pre_requis_missions.id_mission 
                LEFT JOIN batiment as batimentId ON batimentId.id = pre_requis_missions.id_bat
                LEFT JOIN population as populationId ON populationId.id = pre_requis_missions.id_pop ';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function createPrMissionBase(){
           
        $sql = 'INSERT INTO pre_requis_missions(id_mission,id_bat,niveau_bat,id_pop,nombre_pop)VALUES (?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idMission,$this->idBat,$this->niveauBat,$this->idPop,$this->nombrePop]);
       
    }

    public function verifMissionPRExistById(){
        
        $sql = 'SELECT id FROM pre_requis_missions WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }

    public function supprMissionPR(){
        $sql= 'DELETE FROM pre_requis_missions WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function modifPrMissionBase(){
        $sql = 'UPDATE pre_requis_missions SET id_mission = ?, id_bat = ?,niveau_bat = ?,id_pop = ?, nombre_pop = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idMission, $this->idBat,$this->niveauBat,$this->idPop,$this->nombrePop,$this->idLigne]);
    }

    public function getQuestionMissionBaseAdmin(){
        $sql ='SELECT * FROM missions_texte_q
               LEFT JOIN missions as missionsId ON missionsId.id = missions_texte_q.id_mission ';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }    

    public function createMissionQuestion(){
        $sql = 'INSERT INTO missions_texte_q(id_mission,texte,last_question,first_question,reussite_echec) VALUES(?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idMission,$this->texteMission, $this->lastQuestion,$this->firstQuestion, $this->reussiteEchec]);
    }

    public function verifQuestionMissionExistById(){
        
        $sql = 'SELECT id FROM missions_texte_q WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }

    public function supprMissionQ(){
        $sql= 'DELETE FROM missions_texte_q WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function modifMissionQuestion(){
        $sql = 'UPDATE missions_texte_q SET id_mission = ?, texte = ?, last_question = ?, first_question = ?, reussite_echec = ? WHERE id= ?';
        return $this->createQuery($sql,[$this->idMission, $this->texteMission, $this->lastQuestion, $this->firstQuestion, $this->reussiteEchec, $this->idLigne]);
    }

    public function getReponseMissionBaseAdmin(){
        $sql = 'SELECT * FROM missions_texte_r
                LEFT JOIN missions as missionsId ON missionsId.id = missions_texte_r.id_mission';
        $result = $this->createQuery($sql);
        return $result->fetchAll();

    }

    public function createMissionReponse(){
        $sql = 'INSERT INTO missions_texte_r(id_mission, id_question, id_texte_q_cible, texte) VALUES (?,?,?,?)';
        return $this->createQuery($sql,[$this->idMission,$this->texteQLien, $this->texteQCible,$this->texteMission]);
    }

    public function verifReponseMissionExistById(){
        
        $sql = 'SELECT id FROM missions_texte_r WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }

    public function supprMissionR(){
        $sql= 'DELETE FROM missions_texte_r WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function modifMissionReponse(){
        $sql = 'UPDATE missions_texte_r SET id_mission = ?, texte = ?, id_question = ?, id_texte_q_cible = ? WHERE id= ?';
        return $this->createQuery($sql,[$this->idMission, $this->texteMission, $this->texteQLien, $this->texteQCible, $this->idLigne]);
    }
}