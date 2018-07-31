<?php

require dirname(__DIR__).'/app/config/Configs.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tchat
 *
 * @author pkpwang
 */
class Tchat 
{
    /**
     *
     * @var type 
     */
    private static $_instance = null;
    
    /**
     * 
     * @return \Tchat
     */
    private function __construct()
    {
        return $this;
    }    
    
    /**
     * 
     * @return type
     */
    public static function getInstance()
    { 
        if (is_null(self::$_instance)) 
        {
            self::$_instance = new Tchat();
        } 
        return self::$_instance;
    }
    
    /**
     * Méthode qui permet d'appeller le controlleur demandé et exécute l'action cible
     * Par défaut on appelle la homepage
     * @param type $controller
     * @param type $action
     */
    public function execute($controller=NULL, $action=NULL)
    {        
        if (isset($controller))
        {
            $congs = new Configs();
            $controller_class = ucfirst($controller)."Controller";
            $controller_file = $congs->confs['PATH_CONTROLLER'].$controller_class.'.php';            
            $method = (isset($action)) ? $action."Action" : 'defaultAction';
            
            try
            {                
                if (is_file($controller_file))
                {                    
                    include_once $controller_file;
                    if (class_exists($controller_class))
                    {                        
                        $new_controller = new $controller_class();                        
                        if (method_exists($new_controller, $method))
                        {                            
                            $new_controller->$method();
                            die();
                        }
                        else
                        {                            
                            die("La méthode appelé n'existe pas!");
                        }
                    }
                }
            } 
            catch (Exception $ex) 
            {
                exit('Une erreur est survenue' . $ex->getMessage());
            }                        
        }
    }
}
