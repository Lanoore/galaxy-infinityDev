<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGITechnologie extends ManagerBDD
{
    
    /**
     * getTechno
     * 
     * Récupère la technologie sélectionner
     *
     * @return array
     */
    public function getTechno(){
        $sql = 'SELECT * FROM technologie
                LEFT JOIN technologie_planete ON technologie.id = technologie_planete.technologie_id

         WHERE technologie_id = ? AND planete_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * getTechnoBase
     * 
     * Récupère les technologies de base
     *
     * @return array
     */
    public function getTechnoBase(){
        $sql = 'SELECT * FROM technologie 
                LEFT JOIN technologie_planete ON technologie.id = technologie_planete.technologie_id 
                WHERE planete_id =? AND tier = ? ORDER BY technologie.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }
    
    /**
     * getTechnoBaseCraft
     * 
     * Récupère les craft des technologies
     *
     * @return array
     */
    public function getTechnoBaseCraft(){
        $sql = 'SELECT * FROM technologie_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getCraftTechnoX
     * 
     * Récupère le craft de la technologie sélectionner
     *
     * @return array
     */
    public function getCraftTechnoX(){
        $sql = 'SELECT * FROM technologie_craft 
                LEFT JOIN craft ON technologie_craft.craft_id = craft.id
                LEFT JOIN items ON technologie_craft.items_id = items.id
        WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->idNiveau]);
        return $result->fetchAll();
    }
    
    /**
     * getPrTechnoX
     * 
     * Récupère les pré-requis de la technologie sélectionner
     *
     * @return array
     */
    public function getPrTechnoX(){
        $sql = 'SELECT * FROM pre_requis_technologie WHERE technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno]);
        return $result->fetchAll();
    }
    
    /**
     * getBatPlaneteX
     * 
     * Récupère le batiment sur la planete demander
     *
     * @return array
     */
    public function getBatPlaneteX(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBatRequis]);
        return $result->fetch();
    }
    
    /**
     * getTechnoPlaneteX
     * 
     * Récupère la technologie sur la planete demander
     *
     * @return array
     */
    public function getTechnoPlaneteX(){
        
        $sql = 'SELECT * FROM technologie_planete WHERE planete_id = ? AND technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idTechnoRequis]);
        return $result->fetch();
    }
    
    /**
     * getCraftPlaneteX
     * 
     * Récupère le craft sur la planete demander
     *
     * @return array
     */
    public function getCraftPlaneteX(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idCraft]);
        return $result->fetch();
    }
    
    /**
     * getItemsPlaneteX
     * 
     * Récupère l'item sur la planete demander
     *
     * @return array
     */
    public function getItemsPlaneteX(){
        $sql = 'SELECT * FROM items_planete WHERE planete_id = ? AND items_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idItems]);
        return $result->fetch();
    }
    
    /**
     * verifTechnoEnCours
     * 
     * Vérifie si une technologie est deja en cours de construction
     *
     * @return int
     */
    public function verifTechnoEnCours(){
        $sql ='SELECT * FROM construction_technologie_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }
    
    /**
     * verifTechnoExist
     *
     * Vérifie si la technologie existe
     * 
     * @return int
     */
    public function verifTechnoExist(){
        $sql ='SELECT * FROM  technologie WHERE id=?';
        $result =$this->createQuery($sql,[$this->idTechno]);
        return $result->rowCount();
    }
    
    /**
     * updateCraftXPlaneteX
     * 
     * Update le craft sur la planete sélectionner
     *
     * @return bool
     */
    public function updateCraftXPlaneteX(){
        $sql = 'UPDATE craft_planete SET nombre_craft = ? WHERE planete_id = ? AND craft_id = ?';
        return $result = $this->createQuery($sql,[$this->nbCraftFinal,$this->idPlanete,$this->idCraft]);
    }
    
    /**
     * updateItemsXPlaneteX
     * 
     * Update l'item sur la planet sélectionner
     *
     * @return bool
     */
    public function updateItemsXPlaneteX(){
        $sql = 'UPDATE items_planete SET nombre_items = ? WHERE planete_id = ? AND items_id = ?';
        return $result = $this->createQuery($sql,[$this->nbItemsFinal, $this->idPlanete,$this->idItems]);
    }
    
    /**
     * getTempsConstruTechno
     * 
     * Récupère le temps de construction de la technologie/niveau sélectionner
     *
     * @return array
     */
    public function getTempsConstruTechno(){
        $sql = 'SELECT * FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql ,[$this->idTechno, $this->idNiveau]);
        return $result->fetch();
    }
    
    /**
     * addConstructionTechno
     * 
     * Ajoute la technologie dans la liste de construction
     *
     * @return bool
     */
    public function addConstructionTechno(){
        $sql ='INSERT INTO construction_technologie_planete(planete_id,technologie_id,fin_technologie_actuel,niveau_technologie_construction)VALUES(?,?,?,?)';
        return $result = $this->createQuery($sql,[$this->idPlanete,$this->idTechno,$this->finConstruActuel,$this->idNiveau]);
    }
    
    /**
     * getConstruTechnoEnCours
     * 
     * Récupère la technologie en cours de construction
     *
     * @return array
     */
    public function getConstruTechnoEnCours(){
        $sql ='SELECT * FROM construction_technologie_planete
                LEFT JOIN technologie ON construction_technologie_planete.technologie_id = technologie.id
            WHERE planete_id = ?';
            $result = $this->createQuery($sql,[$this->idPlanete]);
            return $result->fetch();        
    }
    


}