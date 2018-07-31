<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tchat PHP MVC</title>
    
    <link rel="stylesheet" type="text/css" href="../src/Ressources/public/public/css/global.css" />    
    <link rel="stylesheet" type="text/css" href="../src/Ressources/public/public/css/bootstrap.min.css" />    
</head>
<body>

<div class="container">
<?php 
    if (!isset($_SESSION['id'])) 
    {
?>
    <div>
        <a href="http://localhost/tchat/web/?c=main&act=loginForm">Se logger</a> | <a href="http://localhost/tchat/web/?c=main&act=inscription">S'inscrire</a>
    </div>
<?php
    }
?>
<div class="page-header">
    <div>
        <h2>Bonjour <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?></h2> 
    </div>    
    
    <?php if (isset($_SESSION['id'])){ ?>
    <div ><a href="http://localhost/tchat/web/?c=main&act=logout">Se déconnecter</a></div>
    <?php } ?>
        
</div>
    

<!-- Responsive Chat - START -->
<div class="container">
    <div class="row">
   