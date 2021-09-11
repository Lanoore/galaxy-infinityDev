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

    public function getChatGuilde(){
        $sql = 'SELECT chat_guilde.id , user.pseudo, chat_guilde.message, chat_guilde.dateMessage FROM chat_guilde INNER JOIN user ON chat_guilde.idUser = user.id WHERE chat_guilde.idGuilde = ? ORDER BY dateMessage DESC LIMIT 20';
        $result = $this->createQuery($sql,[$this->idGuilde]);
        return  $result->fetchAll(); 
    }

    public function addMessageGuilde(){
        $sql = 'INSERT INTO chat_guilde(idUser,message,dateMessage,idGuilde)VALUES(?,?,NOW(),?)';
        $result = $this->createQuery($sql,[$this->idUser,$this->messageGuilde,$this->idGuilde]);

        return $result;
    }
}