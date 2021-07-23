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
        $sql ='INSERT INTO population(typeUnite,nom,description,tier,image) VALUES(?,?,?,?,?)';
        return $this->createQuery($sql,[$this->typeUnite,$this->nomPop,$this->descrPop,$this->tierPop,$this->imagePop]);
    }


    public  function supprPopBase(){
        $sql = 'DELETE FROM population WHERE id = ?';
        return $this->createQuery($sql,[$this->idPop]);
    }

    public function modifPopBase(){
        $sql = 'UPDATE population SET typeUnite = ?, nom = ?, description = ?, tier = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->typeUnite, $this->nomPop, $this->descrPop,$this->tierPop,$this->idPop]);

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


}