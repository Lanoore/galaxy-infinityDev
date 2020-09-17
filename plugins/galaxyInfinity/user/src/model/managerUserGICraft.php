<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGICraft extends ManagerBDD
{
    
    /**
     * getCraft
     * 
     * Récupre le craft par rapport a son id
     *
     * @return array
     */
    public function getCraft(){
        $sql = 'SELECT * FROM craft WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        return $result->fetch();
    }

    
    /**
     * getCraftBase
     * 
     * Récupère les crafts de base
     *
     * @return array
     */
    public function getCraftBase(){
        $sql = 'SELECT * FROM craft LEFT JOIN craft_planete ON craft.id = craft_planete.craft_id 
                WHERE planete_id =? AND tier = ? ORDER BY craft.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }
    
    /**
     * getCraftBaseCraft
     * 
     * Récupère tout les craft des crafts
     *
     * @return array
     */
    public function getCraftBaseCraft(){
        $sql = 'SELECT * FROM craft_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getCraftCraftX
     * 
     * Récupère les craft du craft sélectionner
     *
     * @return array
     */
    public function getCraftCraftX(){
        $sql = 'SELECT * FROM craft_craft 
                LEFT JOIN craft ON craft_craft.craft_id_travail = craft.id
                LEFT JOIN ressource ON craft_craft.ressource_id = ressource.id
        WHERE craft_id = ?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        return $result->fetchAll();
    }
    
    /**
     * getPrCraftX
     * 
     * Récupère les pré-requis du craft sélectionner
     *
     * @return array
     */
    public function getPrCraftX(){
        $sql = 'SELECT * FROM pre_requis_craft WHERE craft_id = ?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        return $result->fetchAll();
    }
    
    /**
     * getBatPlaneteX
     * 
     * Récupère les batiments de la planete sélectionner
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
     * Récupère les technologies de la planete sélectionner
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
     * Récupère les crafts de la planete sélectionner
     *
     * @return array
     */
    public function getCraftPlaneteX(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idCraft]);
        return $result->fetch();
    }
    
    /**
     * getRessourcePlaneteX
     * 
     * Récupère les ressources de la planete sélectionner
     *
     * @return array
     */
    public function getRessourcePlaneteX(){
        $sql = 'SELECT * FROM ressource_planete WHERE planete_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idRessource]);
        return $result->fetch();
    }

    
    /**
     * verifCraftExist
     * 
     * Vérifie si le craft existe
     *
     * @return int
     */
    public function verifCraftExist(){
        $sql = 'SELECT * FROM craft WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        return $result->rowCount();
    }
    
    /**
     * verifCraftEnCours
     * 
     * Vérifie si un craft est en cours
     *
     * @return int
     */
    public function verifCraftEnCours(){
        $sql ='SELECT * FROM construction_craft_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }
    
    /**
     * addConstructionCraft
     * 
     * Ajoute le craft dans la chaine de construction
     *
     * @return bool
     */
    public function addConstructionCraft(){
        $sql = 'INSERT INTO construction_craft_planete(planete_id,craft_id,fin_craft_actuel,nombre_craft_total) VALUES(?,?,?,?)';
        return $result = $this->createQuery($sql,[$this->idPlanete,$this->idCraft,$this->finCraftActuel,$this->nombreCraft]);
    }

    
    /**
     * updateCraftXPlaneteX
     * 
     * Update le nombre de craft sur la planete
     *
     * @return bool
     */
    public function updateCraftXPlaneteX(){
        $sql = 'UPDATE craft_planete SET nombre_craft = ? WHERE planete_id = ? AND craft_id = ?';
        return $result = $this->createQuery($sql,[$this->nbCraftFinal,$this->idPlanete,$this->idCraft]);
    }
    
    /**
     * updateRessourceXPlaneteX
     * 
     * Update le nombre de ressource sur la planete
     *
     * @return bool
     */
    public function updateRessourceXPlaneteX(){
        $sql = 'UPDATE ressource_planete SET nombre_ressource = ? WHERE planete_id = ? AND ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->nbRessourceFinal,$this->idPlanete,$this->idRessource]);
    }
    
    /**
     * getConstruCraftEnCours
     * 
     * Récupère la construction du craft en cours
     *
     * @return void
     */
    public function getConstruCraftEnCours(){
        $sql ='SELECT * FROM construction_craft_planete
                LEFT JOIN craft ON construction_craft_planete.craft_id = craft.id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

}