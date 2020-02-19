<?php session_start(); ?>

<!DOCTYPE html>
<?php include ('catalogue.php');
include('functions.php');?>
<html>
<head>
    <title> Boutique Peace'n'love </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
</head>
<body>
<header class="hero" >
    <h2 class ="titre_catalogue d-sm-flex"> BOUTIQUE PEACE'N'LOVE </h2>
    <p > Vous voulez en avoir plein les yeux? Votre porte-monnaie pèse trop lourd?
        Alors venez faire un tour dans mon e-boutique -
        le meilleur magasin en ligne du prêt-à-porter dans tout Apprieu!</p>
</header>

<div class="navigation_interne">

    <ul class ="nav justify-content-end nav-tabs">
        <li class ="nav-item"><a class="nav-link" href="index.php">Catalogue</a></li>
        <li class ="nav-item"><a class="nav-link" href="panier.php">Mon Panier</a></li>
        <li class ="nav-item"><a class="nav-link" href="panier.php?fonction=deletePanier">Vider le panier</a></li>

    </ul>
</div>