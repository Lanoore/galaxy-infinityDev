<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIPlanete extends ManagerBDD
{

    public function getPlanete(){
        $sql ='SELECT * FROM planete WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        $result = $result->fetch();
        $this->systeme = $result['systeme'];
        $this->position = $result['position'];
        $this->lastActivite = $result['last_activite'];
    }


    public function changeLastActivitePlanete(){
        $sql = 'UPDATE planete SET last_activite = ? WHERE id = ?';
        return $result = $this->createQuery($sql,[$this->lastActivite, $this->idPlanete]);
    }

    public function getBatimentProd(){
        $sql ='SELECT * FROM batiment_prod_ressource';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getNiveauBatiment(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBat]);
        return $result->fetch();
    }

    public function getProdRessource(){
        $sql = 'SELECT * FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat, $this->niveauBat]);
        return $result->fetch();
    }

    public function getRessourcePlanete(){
        $sql = 'SELECT * FROM ressource_planete WHERE planete_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idRessource]);
        return $result->fetch();
    }

    public function changeNombreRessource(){
        $sql ='UPDATE ressource_planete SET nombre_ressource = ? WHERE planete_id = ? AND ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->totalRessource,$this->idPlanete, $this->idRessource]);
        
    }

    public function getConstruCraftEnCours(){
        $sql = 'SELECT * FROM construction_craft_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

    public function addNombreCraftInPlanete(){
        $sql = 'UPDATE craft_planete SET nombre_craft = ? WHERE planete_id = ? AND craft_id = ?';
        return $result =$this->createQuery($sql,[$this->nombreCraftTotal,$this->idPlanete, $this->idCraft]);
    }
    
    public function getNbCraftActuel(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result =$this->createQuery($sql,[$this->idPlanete, $this->idCraft]);
        return $result->fetch();
    }

    public function supprLigneCraftEnCoursPlanete(){
        $sql = 'DELETE FROM construction_craft_planete WHERE planete_id = ?';
        return $result = $this->createQuery($sql,[$this->idPlanete]);
    }

    public function getConstruBatEnCours(){
        $sql = 'SELECT * FROM construction_batiment_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

    public function modifNiveauBatPlanete(){
        $sql ='UPDATE batiment_planete SET niveau = ? WHERE planete_id = ? AND batiment_id = ?';
        return $result = $this->createQuery($sql,[$this->niveauBatFinal,$this->idPlanete,$this->idBat]);    
    }

    public function supprLigneBatEnCoursPlanete(){
        $sql ='DELETE FROM construction_batiment_planete WHERE planete_id = ?';
        return $result = $this->createQuery($sql,[$this->idPlanete]);
    }

    public function getConstruTechnoEnCours(){
        $sql = 'SELECT * FROM construction_technologie_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

    public function modifNiveauTechnoPlanete(){
        $sql ='UPDATE technologie_planete SET niveau = ? WHERE planete_id = ? AND technologie_id = ?';
        return $result = $this->createQuery($sql,[$this->niveauBatFinal,$this->idPlanete,$this->idTechno]);    
    }

    public function supprLigneTechnoEnCoursPlanete(){
        $sql ='DELETE FROM construction_technologie_planete WHERE planete_id = ?';
        return $result = $this->createQuery($sql,[$this->idPlanete]);
    }

}