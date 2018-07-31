<?php
include dirname(__DIR__).'/Repository/Connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author pkpwang
 */
class User
{
    public $email;
    public $password;
    
    /**
     * 
     * @return type
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * 
     * @param type $email
     * @return \User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getMdp()
    {
        return $this->password;
    }
    
    /**
     * 
     * @param type $password
     * @return \User
     */
    public function setMdp($password)
    {
        $this->password = $password;
        return $this;
    }   
    
    /**
     * vérification d'un doublon dans la table en l'occurence le mail deja existant
     * @param type $field
     * @param type $email
     * @return type
     */
    static public function checkIfExistEmail($field, $email)
    {
        return Connection::checkIfEmailExist($field, $email);
    } 
    
    /**
     * 
     * @return bool
     */
    public function adduser()
    {
        return Connection::addNewUser($this);
    }
    
    /**
     * Authentification d'un user
     * @param type $email
     * @param type $mdp
     * @return bool
     */
    static public function login($email, $mdp)
    {        
        return Connection::login($email, $mdp);
    }
}
