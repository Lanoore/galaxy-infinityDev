<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGICraft extends ManagerBDD
{
    function __construct(){
        $this->idCraft = null;
        $this->nomCraft = null;
        $this->descrCraft = null;
        $this->tierCraft = null;
        $this->tempsBase = null;

    }

    public function getCraftBaseById(){
        
        $sql = 'SELECT nom,description,tier,temps_base FROM craft WHERE id =?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        $result = $result->fetch();
    
        $this->nomCraft = $result['nom'];
        $this->descrCraft = $result['description'];
        $this->tierCraft = $result['tier'];
        $this->tempsBase = $result['temps_base'];
    }
    
       public function verifCraftExist(){
          
           $sql ='SELECT nom FROM craft WHERE nom = ?';
           $result = $this->createQuery($sql,[$this->nomCraft]);
           $result = $result->rowCount();

           $this->craftExist = $result;
       }
    
       public function insertCraftBase(){
           
           $sql ='INSERT INTO craft(nom,description,tier,temps_base) VALUES(?,?,?,?)';
           $result = $this->createQuery($sql,[$this->nomCraft,$this->descrCraft,$this->tierCraft,$this->tempsCraft]);
           return $result;
       }
    
       
       public function getCraftBaseAdmin(){
           
           $sql ='SELECT * FROM craft ORDER BY tier DESC';
           $result = $this->createQuery($sql);
           return $result->fetchAll();
       }
    
    
       public function modifCraftBase(){

        $sql = 'UPDATE craft SET nom = ?, description = ?, tier = ?, temps_base = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomCraft, $this->descrCraft,$this->tierCraft,$this->tempsCraft,$this->idCraft]);
    
        return $result;
        }
    
        public  function supprCraftBase(){
            $sql = 'DELETE FROM craft WHERE id = ?';
            $result = $this->createQuery($sql,[$this->idCraft]);
    
            return $result;
        }

        public function getCraftCraftAdmin(){
            $sql = 'SELECT * FROM craft_craft';
            $result = $this->createQuery($sql);
            return $result->fetchAll();
        }

        public function verifCraftCraftExist(){
            $sql = 'SELECT ressource_id, craft_id FROM craft_craft WHERE craft_id = ? AND ressource_id =? OR craft_id_travail =?';
            $result = $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->craftTravail]);
            return $result->rowCount();
        }
        
        public function createCraftCraft(){
            $sql = 'INSERT INTO craft_craft(craft_id,ressource_id,nombre_ressource,craft_id_travail,nombre_craft_travail)VALUES(?,?,?,?,?)';
            $result = $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->nombreRessource,$this->craftTravail,$this->nombreCraftTravail]);
            return $result;
        }

        public function verifExistCraftCraftById(){
            $sql = 'SELECT id FROM craft_craft WHERE id = ?';
            $result = $this->createQuery($sql,[$this->idLigne]);
            return $result->rowCount();
        }

        public function supprCraftCraft(){
            $sql = 'DELETE FROM craft_craft WHERE id = ?';
            $result = $this->createQuery($sql,[$this->idLigne]);
            return $result;
        }

        public function modifCraftCraft(){
            $sql = 'UPDATE craft_craft SET craft_id = ?, ressource_id = ?, nombre_ressource = ?, craft_id_travail = ?,nombre_craft_travail =? WHERE id =?';
            $result = $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->nombreRessource,$this->craftTravail,$this->nombreCraftTravail,$this->idLigne]);
            return $result;
        }
}