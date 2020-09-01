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
   }

    public function verifBatExist(){
    
    $sql = 'SELECT id FROM batiment WHERE id = ?';
    $result = $this->createQuery($sql,[$this->idBatiment]);
    $result = $result->rowCount();
    return $result;
    }

    public function insertBatBase(){
    
    $sql ='INSERT INTO batiment(nom,description,tier) VALUES(?,?,?)';
    $result = $this->createQuery($sql,[$this->nomBat,$this->descrBat,$this->tierBat]);
    return $result;
    }

    public function getBatBaseAdmin(){

    $sql ='SELECT * FROM batiment ORDER BY tier DESC';
    $result = $this->createQuery($sql);
    $result = $result->fetchAll();
    return $result;
    }

    public function supprBatBase(){

        $sql='DELETE FROM batiment WHERE id = ?';
        $result= $this->createQuery($sql,[$this->idBatiment]);

        return $result;
    }

    public function modifBatBase(){

        $sql='UPDATE batiment SET nom = ?, description = ?, tier = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomBat,$this->descrBat, $this->tierBat,$this->idBat]);
        return $result;
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
        $result = $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem]);
        return $result;
    }

    public function verifBatCraftNiveauExistById(){
        $sql = 'SELECT id FROM batiment_craft WHERE id= ?';
        $result = $this->createQuery($sql,[$this->idLigne]);
        return $result;
    }

    public function supprBatCraftNiveau(){
        $sql = 'DELETE FROM batiment_craft WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idLigne]);
        return $result;
    }

    public function modifBatCraftNiveau(){
        
        $sql = 'UPDATE batiment_craft SET batiment_id = ?, niveau_id = ?, craft_id = ?,nombre_craft = ?,items_id = ?, nombre_items = ? WHERE id =?';
        $result = $this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem,$this->idLigne]);
        return $result;

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
        $result = $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->tempsConstruction]);
        return $result;
    }

    public function supprBatTempsNiveau(){
        $sql = 'DELETE FROM batiment_niveau WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->niveauBat]);
        return $result;
    }

    public function modifBatTempsNiveau(){
        $sql ='UPDATE batiment_niveau SET batiment_id = ?, niveau_id = ?, temps_construction = ? WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->tempsConstruction,$this->idBat,$this->niveauBat]);
        return $result;
    }

    public function getBatPRAdmin(){
        $sql = 'SELECT * FROM pre_requis_batiment ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifBatPRExist(){
        $sql = 'SELECT batiment_id_requis, technologie_id_requis FROM pre_requis_batiment WHERE batiment_id AND batiment_id_requis OR technologie_id_requis';
        $result = $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->idTechnoPR]);
        return $result->rowCount();
    }

    public function createBatPR(){
       
        $sql = 'INSERT INTO pre_requis_batiment(batiment_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
        $result = $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
       
        return $result;
    }

    public function verifBatPRExistById(){
        
        $sql = 'SELECT id FROM pre_requis_batiment WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }

    public function supprBatPR(){
        $sql= 'DELETE FROM pre_requis_batiment WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idLigne]);
        return $result;
    }

    public function modifBatPR(){
        $sql='UPDATE pre_requis_batiment SET batiment_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
        return $result;
    }
}