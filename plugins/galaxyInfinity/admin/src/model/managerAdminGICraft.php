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
        $this->imageCraft = $result['image'];
    }
    
       public function verifCraftExist(){
          
           $sql ='SELECT nom FROM craft WHERE nom = ?';
           $result = $this->createQuery($sql,[$this->nomCraft]);
           $result = $result->rowCount();

           $this->craftExist = $result;
       }
    
       public function insertCraftBase(){
           
           $sql ='INSERT INTO craft(nom,description,tier,temps_base,image) VALUES(?,?,?,?,?)';
           return $this->createQuery($sql,[$this->nomCraft,$this->descrCraft,$this->tierCraft,$this->tempsCraft,$this->imageCraft]);
           
       }
    
       
       public function getCraftBaseAdmin(){
           
           $sql ='SELECT * FROM craft ORDER BY tier DESC';
           $result = $this->createQuery($sql);
           return $result->fetchAll();
       }
    
    
       public function modifCraftBase(){

        $sql = 'UPDATE craft SET nom = ?, description = ?, tier = ?, temps_base = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomCraft, $this->descrCraft,$this->tierCraft,$this->tempsCraft,$this->idCraft]);
    
        
        }
    
        public  function supprCraftBase(){
            $sql = 'DELETE FROM craft WHERE id = ?';
            return $this->createQuery($sql,[$this->idCraft]);
    
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
            return $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->nombreRessource,$this->craftTravail,$this->nombreCraftTravail]);
            
        }

        public function verifExistCraftCraftById(){
            $sql = 'SELECT id FROM craft_craft WHERE id = ?';
            $result = $this->createQuery($sql,[$this->idLigne]);
            return $result->rowCount();
        }

        public function supprCraftCraft(){
            $sql = 'DELETE FROM craft_craft WHERE id = ?';
            return $this->createQuery($sql,[$this->idLigne]);
            
        }

        public function modifCraftCraft(){
            $sql = 'UPDATE craft_craft SET craft_id = ?, ressource_id = ?, nombre_ressource = ?, craft_id_travail = ?,nombre_craft_travail =? WHERE id =?';
            return $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->nombreRessource,$this->craftTravail,$this->nombreCraftTravail,$this->idLigne]);
            
        }


        public function getCraftPRAdmin(){
            $sql = 'SELECT * FROM pre_requis_craft ORDER BY craft_id ASC';
            $result = $this->createQuery($sql);
            return $result->fetchAll();
        }
    
        public function verifCraftPRExist(){
            $sql = 'SELECT batiment_id_requis, technologie_id_requis FROM pre_requis_craft WHERE craft_id =? AND batiment_id_requis = ? OR technologie_id_requis = ?';
            $result = $this->createQuery($sql,[$this->idCraft,$this->idBatPR,$this->idTechnoPR]);
            return $result->rowCount();
        }
    
        public function createCraftPR(){
           
            $sql = 'INSERT INTO pre_requis_craft(craft_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
            return $this->createQuery($sql,[$this->idCraft,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
           
            
        }
    
        public function verifCraftPRExistById(){
            
            $sql = 'SELECT id FROM pre_requis_craft WHERE id = ?';
            
            $result = $this->createQuery($sql,[$this->idLigne]);
           
            return $result->rowCount();
        }
    
        public function supprCraftPR(){
            $sql= 'DELETE FROM pre_requis_craft WHERE id = ?';
            return $this->createQuery($sql,[$this->idLigne]);
            
        }
    
        public function modifCraftPR(){
            
            $sql='UPDATE pre_requis_craft SET craft_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
            return $this->createQuery($sql,[$this->idCraft,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
            
        }
}