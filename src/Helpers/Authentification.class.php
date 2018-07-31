<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Authentification
 *
 * @author pkpwang
 */
class Authentification extends Connection
{    
    public $authenticated = false;
    public $Attributes = array();
    
    /**
     * 
     */
    public function __construct()
    {        
        if (isset($_SESSION['id'], $_SESSION['email']))
        {
            $this->Attributes['id'] = $_SESSION['id'];
            $this->Attributes['email'] = $_SESSION['email'];            
            $this->authenticated = true;            
        }
        else
        {
            session_start();
        }
    }
    
    /**
     * Essaie d'authentification d'un user
     * @param type $email
     * @param type $mdp
     * @return type
     */
    static public function login($email, $mdp) 
    {       
        $user_datas = parent::login($email, $mdp);
        if (isset($user_datas) && count($user_datas) > 0)
        {         
            $_SESSION['id'] = $user_datas['id'];
            $_SESSION['email'] = $user_datas['email'];        
            return $user_datas;
        }        
    }    
}
