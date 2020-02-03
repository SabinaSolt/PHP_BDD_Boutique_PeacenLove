<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <title> Boutique Peace'n'love </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
</head>
<body>

<?php

include ('catalogue.php');
include('totalPanier.php')
?>
<header class="hero" >
    <h2 class ="titre_catalogue"> BOUTIQUE PEACE'N'LOVE </h2>
    <p > Vous voulez en avoir plein les yeux? Votre porte-monnaie pèse trop lourd? Alors venez faire un tour dans mon e-boutique -
        le meilleur magasin en ligne du prêt-à-porter dans tout Apprieu!</p>
</header>
<div class="container p-3 my-3   border bg-dark text-white rounded ">
    <h2 class="form-label col-sm-12 text-center">Nos articles</h2>
    <br>

    <form  class ="form-horizontal m-3  formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" enctype="multipart/form-data">
        <?php foreach($arr_catalogue as $index=>$articleCatalogue) {
            if($_SESSION['checkBoxes'][$index]==1) {
            ?>

            <div class="row container my-3 bg-light text-dark rounded ">

                <div class="col-sm-3"> <img class ="" src =" <?php echo $articleCatalogue[2] ?> "alt="image"></div>
                <div class ="col-sm-5 "><?php echo $articleCatalogue[0]?> </div>
                <div class ="col-sm-2 rounded-circle price "> <?php echo $articleCatalogue[1] ?> €</div>
                <input class="form-control col-sm-2 " type="checkbox" name ="<?php echo 'checkbox'.$index?>" checked>

            </div>
            <?php }
        } ?>
        <?php echo '<div class=" sous-total container my-3 mr-3 bg-light text-dark rounded col-sm-2 float-right" > Total: ',
        totalPanier($arr_catalogue,$_SESSION['checkBoxes']), ' €</div>' ?>
        <br>
        <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

    </form>
</div>



</body>
</html>
