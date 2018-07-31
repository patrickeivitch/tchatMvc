<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author pkpwang
 */
class Connection extends PDOStatement
{
    private $_connection;    
    private static $_instance;
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "tchat";
    
    /**
     * 
     * @return type
     */
    public static function getInstance()
    {
        // If no instance then make one
        if (!self::$_instance) 
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * 
     */
    public function __construct()
    {    
        try
        {
            $dns = 'mysql:host=' . $this->_host . ';dbname=' . $this->_database;
            $this->_connection = new PDO($dns, $this->_username, $this->_password);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $this->_connection->exec('SET NAMES utf8');
        }
        catch(\PDOException $e)
        {        
            echo "Failed to conencto to MySQL : " . $e->getMessage();
            exit;
        }
    }
    
    /**
     * 
     * @return type
     */
    public function getConnection()
    {
        return $this->_connection;
    }
    
    /**
     * 
     * @param type $field
     * @param type $email
     * @return boolean
     */
    static public function checkIfEmailExist($field, $email)
    {
        $sql = "SELECT ".$field." FROM user WHERE ".$field." = '".$email."' LIMIT 1";        
        $mysql = self::getDB();
        $query = $mysql->prepare($sql, array());        
        try
        {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = (count($result) > 0) ? true : FALSE; 
            $query->closeCursor();
            unset($sql, $mysql, $query);
        }
        catch (PDOException $e){
            exit("Erreur survenue pendant la requete : " . $e->getMessage());
        }
        return $result;
    }
    
    /**
     * Authentification d'un user
     * @param type $email
     * @param type $mdp
     * @return bool
     */
    static public function login($email, $mdp)
    {
        $sql = "SELECT * FROM user WHERE email = :email AND pwd = :pwd LIMIT 1";        
        $mysql = self::getDB();
        $query = $mysql->prepare($sql);
        $response = array();
        try
        {
            $query->execute(array(':email' => $email, 
                                  ':pwd' => crypt($mdp, '@tchat')));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);            
            if (count($result) > 0 && isset($result[0]['id']))
            {
                $response = $result[0];
            }
            $query->closeCursor();
            unset($sql, $mysql, $query, $result);
        }
        catch (PDOException $e)
        {
            exit("Erreur survenue pendant la requete : " . $e->getMessage());
        }
        return $response;
    }

    /**
     * Ajoute un nouvel user
     * @return type
     */
    static public function addNewUser($user)
    {  
        $result = FALSE;
        $mysql = self::getDB();        
        $sql = "INSERT INTO user (`email`, `pwd`, `created_at`) VALUES(:email, :pwd, :created_at)";
        $query = $mysql->prepare($sql, array());        
        try
        {
            $date = new DateTime();
            $query->execute(array(':email' => $user->email,
                                  ':pwd' => $user->password,
                                  ':created_at' => $date->format('Y-m-d H:i:s')));            
            $result = true;
            $query->closeCursor();
            unset($query, $mysql, $sql);
        }
        catch (PDOException $e)
        {
            exit("Erreur lors de la création du client " . $e->getMessage()); 
        }        
        return $result;
    }
    
    /**
     * 
     * @param type $msg
     * @return boolean
     */
    static public function insertMessage($msg, $id)
    {
        $result = FALSE;
        $mysql = self::getDB();        
        $sql = "INSERT INTO messages (`message`, `created_at`, `sender`) VALUES(:message, :created_at, :sender)";
        $query = $mysql->prepare($sql, array());        
        try
        {
            $date = new DateTime();
            $query->execute(array(':message' => $msg,
                                  ':created_at' => $date->format('Y-m-d H:i:s'),
                                  ':sender' => $id));            
            $result = true;
            $query->closeCursor();
            unset($query, $mysql, $sql);
        }
        catch (PDOException $e)
        {
            exit("Erreur lors de l'ajout du message " . $e->getMessage()); 
        }
        return $result;
    }

    /**
     * 
     * @return type
     */
    static private function getDB()
    {
        $db = Connection::getInstance();
        return $db->getConnection();
    }
}
