<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGITechnologie extends ManagerBDD
{

    public function getTechno(){
        $sql = 'SELECT * FROM technologie
                LEFT JOIN technologie_planete ON technologie.id = technologie_planete.technologie_id

         WHERE technologie_id = ? AND planete_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->idPlanete]);
        return $result->fetch();
    }

    public function getTechnoBase(){
        $sql = 'SELECT * FROM technologie LEFT JOIN technologie_planete ON technologie.id = technologie_planete.technologie_id 
                                       /*LEFT JOIN technologie_niveau ON technologie_planete.niveau = technologie_niveau.niveau_id*/
                WHERE planete_id =? AND tier = ? ORDER BY technologie.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }

    public function getTechnoBaseCraft(){
        $sql = 'SELECT * FROM technologie_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getCraftTechnoX(){
        $sql = 'SELECT * FROM technologie_craft 
                LEFT JOIN craft ON technologie_craft.craft_id = craft.id
                LEFT JOIN items ON technologie_craft.items_id = items.id
        WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->idNiveau]);
        return $result->fetchAll();
    }

    public function getPrTechnoX(){
        $sql = 'SELECT * FROM pre_requis_technologie WHERE technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno]);
        return $result->fetchAll();
    }

    public function getBatPlaneteX(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBatRequis]);
        return $result->fetch();
    }

    public function getTechnoPlaneteX(){
        
        $sql = 'SELECT * FROM technologie_planete WHERE planete_id = ? AND technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idTechnoRequis]);
        return $result->fetch();
    }

    public function getCraftPlaneteX(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idCraft]);
        return $result->fetch();
    }

    public function getItemsPlaneteX(){
        $sql = 'SELECT * FROM items_planete WHERE planete_id = ? AND items_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idItems]);
        return $result->fetch();
    }

    public function verifTechnoEnCours(){
        $sql ='SELECT * FROM construction_technologie_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }

    public function verifTechnoExist(){
        $sql ='SELECT * FROM  technologie WHERE id=?';
        $result =$this->createQuery($sql,[$this->idTechno]);
        return $result->rowCount();
    }

    public function updateCraftXPlaneteX(){
        $sql = 'UPDATE craft_planete SET nombre_craft = ? WHERE planete_id = ? AND craft_id = ?';
        return $result = $this->createQuery($sql,[$this->nbCraftFinal,$this->idPlanete,$this->idCraft]);
    }

    public function updateItemsXPlaneteX(){
        $sql = 'UPDATE items_planete SET nombre_items = ? WHERE planete_id = ? AND items_id = ?';
        return $result = $this->createQuery($sql,[$this->nbItemsFinal, $this->idPlanete,$this->idItems]);
    }

    public function getTempsConstruTechno(){
        $sql = 'SELECT * FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql ,[$this->idTechno, $this->idNiveau]);
        return $result->fetch();
    }

    public function addConstructionTechno(){
        $sql ='INSERT INTO construction_technologie_planete(planete_id,technologie_id,fin_technologie_actuel,niveau_technologie_construction)VALUES(?,?,?,?)';
        return $result = $this->createQuery($sql,[$this->idPlanete,$this->idTechno,$this->finConstruActuel,$this->idNiveau]);
    }

    public function getConstruTechnoEnCours(){
        $sql ='SELECT * FROM construction_technologie_planete
                LEFT JOIN technologie ON construction_technologie_planete.technologie_id = technologie.id
            WHERE planete_id = ?';
            $result = $this->createQuery($sql,[$this->idPlanete]);
            return $result->fetch();        
    }

    public function getTempsConstruTechnoX(){
        $sql ='SELECT * FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->idNiveau]);
        return $result->fetch();
    }

}