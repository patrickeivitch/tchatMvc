<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author pkpwang
 */
class BaseController
{
    /**
     * 
     * @return type
     */
    protected function isAuthenticated()
    {
        return (!isset($_SESSION['id'])) ? false : true;
    }
    
    /**
     * 
     * @param type $tpl
     * @param type $vars
     */
    public function render($tpl, $vars)
    {        
        include_once '/../Ressources/views/header.php';
        include_once '/../Ressources/views/'.$tpl.'.php';
        include_once '/../Ressources/views/footer.php';
    }

    /**
     * 
     * @param type $val
     * @return type
     */
    public function text($val)
    {
        $v=trim($val);
        $v=htmlspecialchars($v);
        return $v;
    }
    
    /**
     * Vérifie si l'email est valide
     * @param type $email
     * @return boolean
     */
    function is_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : FALSE;
    }
    
    
}
