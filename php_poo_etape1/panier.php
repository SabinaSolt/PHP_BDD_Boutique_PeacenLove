<?php
include('entete.php');

$arr_error=[];
$alerte_erreur =false;



// vide le panier en appellant la fonction deletePanier
//!!!! NE MARCHE PLUS
if (isset($_GET['fonction'])) {
    //call_user_func(htmlspecialchars($_GET['fonction']));
    $_SESSION['basket']->viderBasket();
    }

if(!empty($_SESSION['basket']->getBasket())) {
    // initalise les tableau en fonction d'articles choisis
    foreach ($_SESSION['basket']->getBasket() as $index=>$quantite) {
        $arr_error[$index]= "";
    }

    // traitement des quantites
    foreach ($_SESSION['basket']->getBasket() as $index=>$quantite) {
        $nomQuantite = 'quantite' . $index;
        $nomDelete ='delete' . $index;
        //Vérifie que le formulaire a été posté
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
                // si la quantité a été saisi pour un article
                if (isset($_POST[$nomQuantite])) {
                    // verifie que la quantité est un entier
                    if (intval($_POST[$nomQuantite]) > 0) {
                        // ajoute la quantite dans le panier
                        $_SESSION['basket']->updateBasket($index,htmlspecialchars(intval($_POST[$nomQuantite])));
                    } else {
                        $arr_error[$index] = "Quantité doit être un nombre entier supérieur à 0";
                        $alerte_erreur = true;
                    }
                }
                // si on a appuyé sur le bouton Supprimer
                if (isset($_POST[$nomDelete]) AND isset($_SESSION['basket']->getBasket()[$index])) {
                    $_SESSION['basket']->deleteItemBasket($index);
                    unset($arr_error[$index]);
                    unset($_POST['$nomDelete']);
                }
        }
    }

    $_SESSION['arr_error']=$arr_error;
}
// aller à la page choix livraison
if(isset($_POST['buttonPlaceOrder']) AND !$alerte_erreur) {
    header("Location:choixLivraison.php#phrase_accroche");
    exit;
}

?>

<div class="container p-3 my-3   border bg-dark text-white rounded ">
    <h2 class="form-label col-sm-12 text-center " id="votre_panier">Votre panier</h2>
    <br>
    <form  class ="form-horizontal m-3  formulaire " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche" method ="POST" enctype="multipart/form-data">
    <?php
    displayPanier($_SESSION['basket'], $bdd);
    ?>

        <?php  if(!$alerte_erreur) {
                echo '<div class=" sous-total my-3  bg-light text-dark rounded col-sm-3 float-right" > Total: ',
                totalPanier($bdd, $_SESSION['basket']), ' €</div>';
        } ?>
        <br>
        <div class=" col-sm-3 d-inline-flex ">
            <button class="btn btn-primary p-2" type="submit" name="buttonSubmit"> Calculer le total</button>

            <button class="btn btn-primary p-2" type="submit" name="buttonPlaceOrder"> Passer la commande</button>
        </div>
    </form>
</div>
</body>
</html>
