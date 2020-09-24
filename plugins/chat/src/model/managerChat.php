<?php

namespace App\plugins\chat\src\model;

use App\config\ManagerBDD;

class ManagerChat extends ManagerBDD
{
        
    /**
     * getChat
     *
     *  Récupère le chat 
     * 
     *  @return array
     */
    public function getChat(){
        $sql = 'SELECT chat.id , user.pseudo, chat.message, chat.dateMessage FROM chat INNER JOIN user ON chat.idUser = user.id ORDER BY dateMessage DESC LIMIT 20';
        $result = $this->createQuery($sql);
        return  $result->fetchAll(); 


    }

    
    /**
     * addMessage
     *
     *  Ajoute un message dans la bdd
     * 
     * @return bool
     */
    public function addMessage(){
        $sql = 'INSERT INTO chat(idUser,message,dateMessage)VALUES(?,?,NOW())';
        $result = $this->createQuery($sql,[$this->idUser,$this->message]);

        return $result;
    }
}