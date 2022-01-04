<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIPopulation extends ManagerBDD
{    

    public function getPopBaseById(){
        
        $sql = 'SELECT nom,description,tier, image FROM population WHERE id =?';
        $result = $this->createQuery($sql,[$this->idPop]);
        $result = $result->fetch();

        $this->nomPop = $result['nom'];
        $this->descrPop = $result['description'];
        $this->tierPop = $result['tier'];
        $this->imagePop = $result['image'];
    }


    public function getPopsBaseAdmin(){
        $sql = 'SELECT * FROM population ORDER BY tier DESC';
        $result = $this->createQuery($sql);
        return $result = $result->fetchAll();
    }

    public function getPopsPRAdmin(){
        $sql = 'SELECT * FROM pre_requis_population
        LEFT JOIN population ON population.id = pre_requis_population.pop_id
        LEFT JOIN batiment ON batiment.id = pre_requis_population.batiment_id_requis
        LEFT JOIN technologie ON technologie.id = pre_requis_population.technologie_id_requis
        ORDER BY pop_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }


    public function verifPopExist(){
          
        $sql ='SELECT nom FROM population WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomPop]);
        $result = $result->rowCount();

        $this->popExist = $result;
        return $result;
    }

    public function insertPopBase(){
        $sql ='INSERT INTO population(typeUnite,nom,description,tier,image,temps_form) VALUES(?,?,?,?,?,?)';
        return $this->createQuery($sql,[$this->typeUnite,$this->nomPop,$this->descrPop,$this->tierPop,$this->imagePop,$this->tempsForm]);
    }


    public  function supprPopBase(){
        $sql = 'DELETE FROM population WHERE id = ?';
        return $this->createQuery($sql,[$this->idPop]);
    }

    public function modifPopBase(){
        $sql = 'UPDATE population SET typeUnite = ?, nom = ?, description = ?, tier = ?, temps_form = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->typeUnite, $this->nomPop, $this->descrPop,$this->tierPop,$this->tempsForm,$this->idPop]);

    }



    public function createPopPR(){
           
        $sql = 'INSERT INTO pre_requis_population(pop_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idPop,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
       
    }
        
    public function verifPopPRExistById(){
        
        $sql = 'SELECT id FROM pre_requis_population WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }
        

    public function supprPopPR(){
        $sql= 'DELETE FROM pre_requis_population WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }
        

    public function modifPopPR(){
        
        $sql='UPDATE pre_requis_population SET pop_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->idPop,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
        
    }

    public function getAllPlaneteActive(){
        $sql = 'SELECT * FROM planete WHERE situation != 0';
        $result =  $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getPopBaseByName(){
        $sql = 'SELECT * FROM population WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomPop]);
        return $result->fetch();
    }

    public function insertPopBasePlaneteX(){
        $sql = 'INSERT INTO population_planete(nombre_pop,planete_id,pop_id) VALUES(0,?,?)';
        return $this->createQuery($sql,[$this->idPlanete,$this->idPop]);
    }

    public function verifPopFormationExist(){
        $sql = 'SELECT craft_id, pop_id_formation FROM population_formation WHERE pop_id = ? AND craft_id =? OR pop_id_formation =?';
        $result = $this->createQuery($sql,[$this->idPop,$this->idCraft, $this->idPopF]);
        return $result->rowCount();
    }

    public function createPopFormation(){
        $sql = 'INSERT INTO population_formation(pop_id,craft_id,nombre_craft,pop_id_formation,nombre_pop_formation) VALUES(?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idPop,$this->idCraft,$this->nombreCraft,$this->idPopF,$this->nombrePopF]);
    }

    public function getPopFormationAdmin(){

        $sql = 'SELECT * FROM population_formation
            LEFT JOIN population as pop ON population_formation.pop_id = pop.id
            LEFT JOIN craft as craft ON population_formation.craft_id = craft.id
            LEFT JOIN population as popF ON population_formation.pop_id_formation = popF.id
        ORDER BY pop_id DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifPopulationFormationExistById(){
        $sql = 'SELECT id FROM population_formation WHERE id= ?';
       return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function supprPopulationFormation(){
        $sql = 'DELETE FROM population_formation WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }

    public function modifPopulationFormation(){
        $sql = 'UPDATE population_formation SET pop_id = ?, craft_id = ?,nombre_craft = ?,pop_id_formation = ?, nombre_pop_formation = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idPop,$this->idCraft,$this->nombreCraft,$this->idPopF,$this->nombrePopF,$this->idLigne]);
    }



}