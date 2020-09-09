<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIBatiment extends ManagerBDD
{
    function __construct($idBatiment = null){
        $this->idBat = null;
        $this->nomBat = null;
        $this->descrBat = null;
        $this->tierBat = null;

        if($idBatiment != null){
            $this->idBat = $idBatiment;

            $this->getBatBaseById();
        }
   }

   public function getBatBaseById(){
       $sql ='SELECT * FROM batiment WHERE id = ?';
       $result = $this->createQuery($sql,[$this->idBat]);
       $result = $result->fetch();

       $this->nomBat = $result['nom'];
       $this->descrBat = $result['description'];
       $this->tierBat = $result['tier'];
       $this->imageBat = $result['image'];
       
   }

    public function verifBatExist(){
    
    $sql = 'SELECT id FROM batiment WHERE id = ?';
    $result = $this->createQuery($sql,[$this->idBat]);
    return $result->rowCount();
    
    }

    public function insertBatBase(){
    
    $sql ='INSERT INTO batiment(nom,description,tier,image) VALUES(?,?,?,?)';
    return $this->createQuery($sql,[$this->nomBat,$this->descrBat,$this->tierBat, $this->imageBat]);

    }

    public function getBatBaseAdmin(){

    $sql ='SELECT * FROM batiment ORDER BY tier DESC';
    $result = $this->createQuery($sql);
    return $result->fetchAll();

    }

    public function supprBatBase(){

        $sql='DELETE FROM batiment WHERE id = ?';
        return $this->createQuery($sql,[$this->idBat]);

        
    }

    public function modifBatBase(){

        $sql='UPDATE batiment SET nom = ?, description = ?, tier = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomBat,$this->descrBat, $this->tierBat,$this->idBat]);
        
    }


    public function getBatNiveauAdmin(){

        $sql = 'SELECT * FROM batiment_craft ORDER BY batiment_id DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifBatCraftNiveauExist(){
        $sql = 'SELECT craft_id, items_id FROM batiment_craft WHERE batiment_id = ? AND niveau_id = ? AND craft_id =? OR items_id =?';
        $result = $this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->idCraft, $this->idItem]);
        return $result->rowCount();
    }

    public function createBatCraftNiveau(){
        $sql = 'INSERT INTO batiment_craft(batiment_id,niveau_id,craft_id,nombre_craft,items_id,nombre_items) VALUES(?,?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem]);
        
    }

    public function verifBatCraftNiveauExistById(){
        $sql = 'SELECT id FROM batiment_craft WHERE id= ?';
       return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function supprBatCraftNiveau(){
        $sql = 'DELETE FROM batiment_craft WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function modifBatCraftNiveau(){
        
        $sql = 'UPDATE batiment_craft SET batiment_id = ?, niveau_id = ?, craft_id = ?,nombre_craft = ?,items_id = ?, nombre_items = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem,$this->idLigne]);
        

    }

    public function getBatTempsNiveauAdmin(){
        $sql = 'SELECT * FROM batiment_niveau ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifBatTempsNiveauExist(){
        $sql = 'SELECT batiment_id,niveau_id FROM batiment_niveau WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->niveauBat]);
        return $result->rowCount();
    }

    public function createBatTempsNiveau(){
        $sql = 'INSERT INTO batiment_niveau(batiment_id,niveau_id,temps_construction)VALUES (?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->tempsConstruction]);
        
    }

    public function supprBatTempsNiveau(){
        $sql = 'DELETE FROM batiment_niveau WHERE batiment_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat]);
        
    }

    public function modifBatTempsNiveau(){
        $sql ='UPDATE batiment_niveau SET batiment_id = ?, niveau_id = ?, temps_construction = ? WHERE batiment_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->tempsConstruction,$this->idBat,$this->niveauBat]);
        
    }

    public function getBatPRAdmin(){
        $sql = 'SELECT * FROM pre_requis_batiment ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifBatPRExist(){
        $sql = 'SELECT batiment_id_requis, technologie_id_requis FROM pre_requis_batiment WHERE batiment_id = ? AND batiment_id_requis = ? OR technologie_id_requis = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->idTechnoPR]);
        return $result->rowCount();
    }

    public function createBatPR(){
       
        $sql = 'INSERT INTO pre_requis_batiment(batiment_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
       
        
    }

    public function verifBatPRExistById(){
        
        $sql = 'SELECT id FROM pre_requis_batiment WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }

    public function supprBatPR(){
        $sql= 'DELETE FROM pre_requis_batiment WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function modifBatPR(){
        $sql='UPDATE pre_requis_batiment SET batiment_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
        
    }

    public function getBatStartPlanete(){
        $sql = 'SELECT * FROM bat_start_planete';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifBatStartPlaneteExist(){
        $sql = 'SELECT batiment_id FROM bat_start_planete WHERE batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idBat]);
        return $result->rowCount();
    }

    public function createBatStartPlanete(){
        $sql = 'INSERT INTO bat_start_planete(batiment_id,niveau_start_id) VALUES(?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau]);
        
    }

    public function supprBatStartPlanete(){
        $sql = 'DELETE FROM bat_start_planete WHERE batiment_id = ?';
       return $this->createQuery($sql,[$this->idBat]);
        
    }

    public function modifBatStartPlanete(){
        $sql = 'UPDATE bat_start_planete SET batiment_id = ?, niveau_start_id = ?';
        return$this->createQuery($sql,[$this->idBat, $this->idNiveau]);
        
    }
}