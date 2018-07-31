<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__. "/../vendor/autoload.php";
require_once __DIR__ . '/../app/Tchat.class.php';

$tchat = \Tchat::getInstance();

if (isset($_GET['c']) && isset($_GET['act']))
{
    $class = htmlentities($_GET['c']);
    $action = htmlentities($_GET['act']);
    $tchat->execute($class, $action);
}
//Page d'accueil par défaut
else
{
    $tchat->execute('main');
}