<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGITechnologie extends ManagerBDD
{
    function __construct($idTechnologie = null){
        $this->idTechno = null;
        $this->nomTechno = null;
        $this->descrTechno = null;
        $this->tierTechno = null;

        if($idTechnologie != null){
            $this->idTechno = $idTechnologie;

            $this->getTechnologieBaseById();
        }
   }

   public function getTechnologieBaseById(){
       $sql ='SELECT * FROM technologie WHERE id = ?';
       $result = $this->createQuery($sql,[$this->idTechno]);
       $result = $result->fetch();

       $this->nomTechno = $result['nom'];
       $this->descrTechno = $result['description'];
       $this->tierTechno = $result['tier'];
       $this->imageTechno = $result['image'];
   }

    public function verifTechnologieExist(){
    
    $sql = 'SELECT id FROM technologie WHERE id = ?';
    $result = $this->createQuery($sql,[$this->idTechno]);
    return $result->rowCount();
    
    }

    public function insertTechnologieBase(){
    
    $sql ='INSERT INTO technologie(nom,description,tier,image) VALUES(?,?,?,?)';
    return $this->createQuery($sql,[$this->nomTechno,$this->descrTechno,$this->tierTechno,$this->imageTechno]);
    
    }

    public function getTechnologieBaseAdmin(){

    $sql ='SELECT * FROM technologie ORDER BY tier DESC';
    $result = $this->createQuery($sql);
    return $result->fetchAll();
    
    }

    public function supprTechnologieBase(){

        $sql='DELETE FROM technologie WHERE id = ?';
        return $this->createQuery($sql,[$this->idTechno]);

    }

    public function modifTechnologieBase(){

        $sql='UPDATE technologie SET nom = ?, description = ?, tier = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomTechno,$this->descrTechno,$this->tierTechno,$this->idTechno]);
        
    }


    public function getTechnologieNiveauAdmin(){

        $sql = 'SELECT * FROM technologie_craft ORDER BY technologie_id DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifTechnologieCraftNiveauExist(){
        $sql = 'SELECT craft_id, items_id FROM technologie_craft WHERE technologie_id = ? AND niveau_id = ? AND craft_id =? OR items_id =?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->niveauTechno,$this->idCraft, $this->idItem]);
        return $result->rowCount();
    }

    public function createTechnologieCraftNiveau(){
        $sql = 'INSERT INTO technologie_craft(technologie_id,niveau_id,craft_id,nombre_craft,items_id,nombre_items) VALUES(?,?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem]);
        
    }

    public function verifTechnologieCraftNiveauExistById(){
        $sql = 'SELECT id FROM technologie_craft WHERE id= ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function supprTechnologieCraftNiveau(){
        $sql = 'DELETE FROM technologie_craft WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
       
    }

    public function modifTechnologieCraftNiveau(){
        
        $sql = 'UPDATE technologie_craft SET technologie_id = ?, niveau_id = ?, craft_id = ?,nombre_craft = ?,items_id = ?, nombre_items = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idTechno, $this->niveauTechno,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem,$this->idLigne]);
        

    }

    public function getTechnologieTempsNiveauAdmin(){
        $sql = 'SELECT * FROM technologie_niveau ORDER BY technologie_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifTechnologieTempsNiveauExist(){
        $sql = 'SELECT technologie_id,niveau_id FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno,$this->niveauTechno]);
        return $result->rowCount();
    }

    public function createTechnologieTempsNiveau(){
        $sql = 'INSERT INTO technologie_niveau(technologie_id,niveau_id,temps_construction)VALUES (?,?,?)';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno,$this->tempsConstruction]);
        
    }

    public function supprTechnologieTempsNiveau(){
        $sql = 'DELETE FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno]);
        
    }

    public function modifTechnologieTempsNiveau(){
        $sql ='UPDATE technologie_niveau SET technologie_id = ?, niveau_id = ?, temps_construction = ? WHERE technologie_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno,$this->tempsConstruction,$this->idTechno,$this->niveauTechno]);
        
    }

    public function getTechnologiePRAdmin(){
        $sql = 'SELECT * FROM pre_requis_technologie ORDER BY technologie_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifTechnologiePRExist(){
        $sql = 'SELECT batiment_id_requis, technologie_id_requis FROM pre_requis_technologie WHERE technologie_id =? AND batiment_id_requis = ? OR technologie_id_requis = ?';
        $result = $this->createQuery($sql,[$this->idTechno,$this->idBatPR,$this->idTechnoPR]);
        return $result->rowCount();
    }

    public function createTechnologiePR(){
       
        $sql = 'INSERT INTO pre_requis_technologie(technologie_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idTechno,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
       
    }

    public function verifTechnologiePRExistById(){
        
        $sql = 'SELECT id FROM pre_requis_technologie WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }

    public function supprTechnologiePR(){
        $sql= 'DELETE FROM pre_requis_technologie WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
    
    }

    public function modifTechnologiePR(){
        
        $sql='UPDATE pre_requis_technologie SET technologie_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->idTechno,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
        
    }
}