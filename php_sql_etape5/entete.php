<?php session_start(); ?>

<!DOCTYPE html>
<?php
$bdd= new PDO ('mysql: host=localhost; dbname=mydb; charset=utf8; port=3308',
    'Sabina','Sabina1', array(PDO:: ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION) );
include('functions.php');
$catalog=$bdd->prepare("SELECT * FROM produit");
$catalog->execute();
?>

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


<header class="hero " >
    <div class="">
        <p class ="titre_catalogue "> BOUTIQUE PEACE'N'LOVE </p>
    <p id="phrase_accroche"> Vous voulez en avoir plein les yeux? Votre porte-monnaie pèse trop lourd?
        Alors venez faire un tour dans mon e-boutique -
        le meilleur magasin en ligne du prêt-à-porter dans tout Apprieu!</p>
    </div>
</header>

<div class="navigation_interne">

    <ul class ="nav justify-content-end nav-tabs">
        <li class ="nav-item"><a class="nav-link" href="index.php#nos_articles">Catalogue</a></li>
        <li class ="nav-item"><a class="nav-link" href="panier.php#votre_panier">Mon Panier</a></li>
        <li class ="nav-item"><a class="nav-link" href="panier.php#votre_panier?fonction=deletePanier">Vider le panier</a></li>
    </ul>
</div>