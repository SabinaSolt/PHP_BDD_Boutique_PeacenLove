<?php
include('entete.php');

$arr_error=[];
$alerte_erreur =false;

$arr_quantite = [];
$_SESSION['quantite'] = [];
// vide le panier en appellant la fonction deletePanier
if (isset($_GET['fonction'])) {call_user_func(htmlspecialchars($_GET['fonction']));}

if(!empty($_SESSION['checkBoxes'])) {
    // initalise les tableau en fonction d'articles choisis
    foreach ($_SESSION['checkBoxes'] as $index=>$iArticlePanier) {
        array_push($arr_quantite, 0);
        array_push($arr_error, "");
    }
    $_SESSION['quantite'] = $arr_quantite;

    // traitement des quantites
    foreach ($_SESSION['checkBoxes'] as $index => $iArticlePanier) {
        $nomQuantite = 'quantite' . $index;
        $nomDelete ='delete' . $index;
        //Vérifie que le formulaire a été posté
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
                // si la quantité a été saisi pour un article
                if (isset($_POST[$nomQuantite])) {
                    // verifie que la quantité est un entier
                    if (intval($_POST[$nomQuantite]) > 0) {
                        $arr_quantite[$index] = intval($_POST[$nomQuantite]);
                    } else {
                        $arr_error[$index] = "Quantité doit être un nombre entier supérieur à 0";
                        $alerte_erreur = true;
                    }
                }
                // si on a appuyé sur le bouton Supprimer
                if (isset($_POST[$nomDelete])) {
                    unset($_SESSION['checkBoxes'][$index]);
                    $arr1=array_values($_SESSION['checkBoxes']);
                    unset($arr_quantite[$index]);
                    $arr2=array_values($arr_quantite);
                    unset($arr_error[$index]);
                    $arr3=array_values($arr_error);

                }
        }
    }
    $_SESSION['quantite'] =$arr_quantite;
}
// revenir à la page catalogue
if(isset($_POST['buttonAddArticle'])) {
    header("Location:http://localhost/tests_Sabina/PHP_Sabina/php_etape8/addArticle.php");
    exit;
}

?>

<div class="container p-3 my-3   border bg-dark text-white rounded ">
    <h2 class="form-label col-sm-12 text-center">Nos articles</h2>
    <br>

    <form  class ="form-horizontal m-3  formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" enctype="multipart/form-data">
        <?php if(!empty($_SESSION['checkBoxes'])) {
            foreach($_SESSION['checkBoxes'] as $index=>$iArticlePanier) {  ?>

                <div class="row container my-3 bg-light text-dark rounded ">

                    <div class="col-sm-2"> <img class ="" src =" <?php echo $arr_catalogue[$iArticlePanier][2] ?> "alt="image"></div>
                    <div class ="col-sm-3 "><?php echo $arr_catalogue[$iArticlePanier][0]?> </div>
                    <div class ="col-sm-2 rounded-circle price "> <?php echo $arr_catalogue[$iArticlePanier][1] ?> €</div>
                    <input class="form-control col-sm-1 " type="checkbox" name ="<?php echo 'checkbox'.$index?>" checked>
                    <div class=" col-sm-2 "> Quantité: <input type="number" name="<?php echo 'quantite' . $index ?>"
                                                              value="<?php echo $_SESSION['quantite'][$index] ?>">
                        <span class="error text-danger"> <?php echo $arr_error[$index] ?></span><br>
                        <button class="btn btn-secondary" type="submit" name="<?php echo 'delete' . $index ?>"> Supprimer</button>
                    </div>
                </div>
                <?php
            }?>
        <?php  if(!$alerte_erreur) {
                echo '<div class=" sous-total container my-3 mr-3 bg-light text-dark rounded col-sm-2 float-right" > Total: ',
                totalPanier($arr_catalogue, $_SESSION['checkBoxes'], $_SESSION['quantite']), ' €</div>';
            }
        } ?>
        <br>
        <div class=" col-sm-2 d-inline-flex ">
            <button class="btn btn-primary p-2" type="submit" name="buttonSubmit"> Calculer le total</button>

            <button class="btn btn-primary p-2" type="submit" name="buttonAddArticle"> Revenir au catalogue</button>
        </div>
    </form>
</div>
</body>
</html>
