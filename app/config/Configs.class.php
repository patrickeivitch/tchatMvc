<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configs
 *
 * @author pkpwang
 */
class Configs
{   
    var $confs = array();
    
    public function __construct()
    {
        $this->confs['PATH_CONTROLLER'] = dirname(__DIR__).'/../src/Controller/';
        return $this;
    }
}
