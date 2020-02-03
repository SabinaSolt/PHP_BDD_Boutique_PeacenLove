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
include('totalPanier.php');
$arr_quantite=[];
$arr_error=[];
$_SESSION['quantite'] =[];
$alerte_erreur =false;


foreach ($arr_catalogue as $index => $articleCatalogue) {
    $nomQuantite = 'quantite' . $index;
    $nomDelete ='delete' . $index;
    if ($_SERVER["REQUEST_METHOD"] == "POST") //Vérifie que le formulaire a été posté
    {
        // si la quantité a été saisi pour un article
        if (isset($_POST[$nomQuantite])) {
            // verifie que la quantité est un entier
            if (is_int(intval($_POST[$nomQuantite]))) {
                array_push($arr_quantite, intval($_POST[$nomQuantite]));
                $arr_error[$index] = "";
            } else {
                $arr_error[$index] = "Quantité doit être un nombre entier";
                $alerte_erreur = true;
                array_push($arr_quantite, 0);
            }
        }
        // si la quantité n'a pas été saisie
        else {
            array_push($arr_quantite, 0);
            $arr_error[$index] = "";
        }
        if(isset($_POST[$nomDelete])) {
            $_SESSION['checkBoxes'][$index]=0;
        }
    }
    // définit les  quantites = 0 si le formulaire n'est pas posté
    else {
        array_push($arr_quantite, 0);
        $arr_error[$index] = "";
    }
}

$_SESSION['quantite'] =$arr_quantite;

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

                <div class="col-sm-2"> <img class ="" src =" <?php echo $articleCatalogue[2] ?> "alt="image"></div>
                <div class ="col-sm-3 "><?php echo $articleCatalogue[0]?> </div>
                <div class ="col-sm-2 rounded-circle price "> <?php echo $articleCatalogue[1] ?> €</div>
                <input class="form-control col-sm-1 " type="checkbox" name ="<?php echo 'checkbox'.$index?>" checked>
                <div class=" col-sm-2 "> Quantité: <input type="number" name="<?php echo 'quantite' . $index ?>"
                                                          value="<?php echo $_SESSION['quantite'][$index] ?>">
                    <span class="error text-danger"> <?php echo $arr_error[$index] ?></span><br>
                    <button class="btn btn-secondary" type="submit" name="<?php echo 'delete' . $index ?>"> Supprimer</button>
                </div>
            </div>
            <?php }
        } ?>
        <?php  if(!$alerte_erreur) {
            echo '<div class=" sous-total container my-3 mr-3 bg-light text-dark rounded col-sm-2 float-right" > Total: ',
            totalPanier($arr_catalogue,$_SESSION['checkBoxes'],$_SESSION['quantite'] ), ' €</div>';
        } ?>
        <br>
        <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

    </form>
</div>



</body>
</html>
