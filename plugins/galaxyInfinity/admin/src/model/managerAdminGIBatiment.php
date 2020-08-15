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
       $sql ='SELECT nom,description,tier FROM batiment WHERE id = ?';
       $result = $this->createQuery($sql,[$this->idBat]);
       $result = $result->fetch();

       $this->nomBat = $result['nom'];
       $this->descrBat = $result['description'];
       $this->tierBat = $result['tier'];
   }

   public function getBatNiveauById(){

    $sql = 'SELECT batiment_id,niveau,craft_id,nombre_craft,items_id,nombre_items FROM batiment_craft WHERE id = ?';
    $result = $this->createQuery($sql,[$this->idLigne]);
    $result = $result->fetch();
    $this->idBat = $result['batiment_id'];
    $this->niveauBat = $result['niveau'];
    $this->idCraft = $result['craft_id'];
    $this->nombreCraft = $result['nombre_craft'];
    $this->idItems = $result['items_id'];
    $this->nombreItems = $result['nombre_items'];
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


public function verifBatNiveauExist(){
   
   $sql = 'SELECT craft_id, items_id FROM batiment_craft WHERE batiment_id = ? AND niveau = ? AND craft_id = ? OR items_id = ?';
   $result=$this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->craftId, $this->itemsId]);
   $result = $result->rowCount();
   $this->batNiveauExist = $result;

}

public function insertBatNiveau(){
   
   $sql ='INSERT INTO batiment_craft(batiment_id,niveau,craft_id,nombre_craft,items_id,nombre_items) VALUES(?,?,?,?,?,?)';
   $result=$this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->craftId,$this->nombreCraft,$this->itemsId,$this->nombreItems]);
   return $insertBatNiveau;
}

public function getBatBaseAdmin(){

   $sql ='SELECT * FROM batiment ORDER BY tier DESC';
   $result = $this->createQuery($sql);
   $result = $result->fetchAll();
   return $result;
}

public function modifBatBase(){
    $sql = 'UPDATE batiment SET nom = ?, description = ?, tier = ? WHERE id = ?';
    $result = $this->createQuery($sql,[$this->nomBat, $this->descrBat,$this->tierBat,$this->idBat]);

    return $result;
}

public function supprBatBase(){

    $sql='DELETE FROM batiment WHERE id = ?';
    $result= $this->createQuery($sql,[$this->idBatiment]);

    return $result;
}

public function getBatNiveauAdmin(){
   
   $sql ='SELECT * FROM batiment_craft ORDER BY batiment_id DESC';
   $result = $this->createQuery($sql);
   return $result;
}
public function modifBatNiveau(){
    
    $sql ='UPDATE batiment_craft SET batiment_id = ?, niveau = ?, craft_id = ?, nombre_craft = ?, items_id = ?, nombre_items = ? WHERE id = ?';
    $result= $this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->idCraft,$this->nombreCraft, $this->idItems,$this->nombreItems, $this->idLigne]);

    return $confirmModif;
}

public function supprBatNiveau($idLigne){
    
    $sql ='DELETE FROM batiment_craft WHERE id = ?';
    $result=$this->createQuery($sql,[$idLigne]);

    return $result;
}



public function insertBatTempsNiveau(){
    
    $sql ='INSERT INTO batiment_niveau(batiment_id, niveau_id,temps_construction) VALUES(?,?,?)';
    $result = $this->createQuery($sql,[$this->idBat,$this->niveauId,$this->tempsConstru]);
    return $result;
}

public function getBatTempsNiveauAdmin(){
    
    $sql ='SELECT batiment_niveau.batiment_id,batiment_niveau.niveau_id,batiment_niveau.temps_construction,batiment.nom nomBatiment FROM batiment_niveau INNER JOIN batiment ON batiment_niveau.batiment_id = batiment.id ORDER BY batiment_id DESC';
    $result = $this->createQuery($sql);

    return $result->fetchAll();
}

}