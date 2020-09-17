<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIBatiment extends ManagerBDD
{

    
    /**
     * getBat
     * 
     * Récupère le batiment via son id et sa planete
     *
     * @return array
     */
    public function getBat(){
        $sql = 'SELECT * FROM batiment
                LEFT JOIN batiment_planete ON batiment.id = batiment_planete.batiment_id

         WHERE batiment_id = ? AND planete_id = ?';
        $result = $this->createQuery($sql,[$this->idBat, $this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * getBatBase
     * 
     * Récupère le batiment de base 
     *
     * @return array
     */
    public function getBatBase(){
        $sql = 'SELECT * FROM batiment 
                LEFT JOIN batiment_planete ON batiment.id = batiment_planete.batiment_id          
                WHERE planete_id =? AND tier = ? ORDER BY batiment.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }
    
    /**
     * getBatBaseCraft
     * 
     * Récupère les craft des batiments
     *
     * @return array
     */
    public function getBatBaseCraft(){
        $sql = 'SELECT * FROM batiment_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getCraftBatX
     * 
     * Récupère les craft du batiment sélectionner par rapport a son niveau
     *
     * @return array
     */
    public function getCraftBatX(){
        $sql = 'SELECT * FROM batiment_craft 
                LEFT JOIN craft ON batiment_craft.craft_id = craft.id
                LEFT JOIN items ON batiment_craft.items_id = items.id

        WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat, $this->idNiveau]);
        return $result->fetchAll();
        
    }
    
    /**
     * getPrBatX
     * 
     * Récupère les pré-requis pour le batiment sélectionner
     *
     * @return array
     */
    public function getPrBatX(){
        $sql = 'SELECT * FROM pre_requis_batiment WHERE batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idBat]);
        return $result->fetchAll();
    }
    
    /**
     * getBatPlaneteX
     * 
     * Récupère les batiments sur la planete sélectionner
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
     * Récupère les technologies sur la planete sélectionner
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
     * Récupère les craft sur la planete demander
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
     * Récupère les items sur la planete demander
     *
     * @return array
     */
    public function getItemsPlaneteX(){
        $sql = 'SELECT * FROM items_planete WHERE planete_id = ? AND items_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idItems]);
        return $result->fetch();
    }

    
    /**
     * verifBatEnCours
     * 
     * Vérifie si une construction est en cours
     *
     * @return int
     */
    public function verifBatEnCours(){
        $sql ='SELECT * FROM construction_batiment_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }

    
    /**
     * verifBatExist
     * 
     * Vérifie si le batiment existe
     *
     * @return int
     */
    public function verifBatExist(){
        $sql ='SELECT * FROM  batiment WHERE id=?';
        $result =$this->createQuery($sql,[$this->idBat]);
        return $result->rowCount();
    }
    
    /**
     * updateCraftXPlaneteX
     * 
     * Met a jour le nombre de craft sur la planete
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
     * Met a jour le nombre d'items sur la planete
     *
     * @return bool
     */
    public function updateItemsXPlaneteX(){
        $sql = 'UPDATE items_planete SET nombre_items = ? WHERE planete_id = ? AND items_id = ?';
        return $result = $this->createQuery($sql,[$this->nbItemsFinal, $this->idPlanete,$this->idItems]);
    }
    
    /**
     * getTempsConstruBat
     * 
     * Récupère le temps de construction du batiment/niveau
     *
     * @return array
     */
    public function getTempsConstruBat(){
        $sql = 'SELECT * FROM batiment_niveau WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql ,[$this->idBat, $this->idNiveau]);
        return $result->fetch();
    }
    
    /**
     * addConstructionBat
     * 
     * Ajoute le batiment dans la liste des constructions
     *
     * @return bool
     */
    public function addConstructionBat(){
        $sql ='INSERT INTO construction_batiment_planete(planete_id,batiment_id,fin_batiment_actuel,niveau_batiment_construction)VALUES(?,?,?,?)';
        return $result = $this->createQuery($sql,[$this->idPlanete,$this->idBat,$this->finConstruActuel,$this->idNiveau]);
    }

    
    /**
     * getConstruBatEnCours
     * 
     * Récupère la construction batiment en cours
     *
     * @return array
     */
    public function getConstruBatEnCours(){
        $sql ='SELECT * FROM construction_batiment_planete
                LEFT JOIN batiment ON construction_batiment_planete.batiment_id = batiment.id
            WHERE planete_id = ?';
            $result = $this->createQuery($sql,[$this->idPlanete]);
            return $result->fetch();        
    }
    

}