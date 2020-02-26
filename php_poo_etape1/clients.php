<?php include('entete.php'); ?>
<?php
$arr_checkbox = [];
$_SESSION['checkBoxes'] = [];

// traitement effectué une fois le formulaire est soumis

if ($_SERVER["REQUEST_METHOD"] == "POST") //Vérifie que le formulaire a été posté
{
//            while ($item = $catalog->fetch()) {
//                $nomCheckbox = 'checkbox' . $item['idProduit'];
//                if (isset($_POST[$nomCheckbox])) {
//                   array_push($arr_checkbox, $item['idProduit']); // stocke l'index de l'article choisi dans catalogue
//
//                }
//            }
//                $_SESSION['checkBoxes'] = $arr_checkbox;
//
//               header("Location:panier.php#phrase_accroche");
//               exit;
}
?>

<div class="container p-3 my-3 border bg-dark text-white rounded ">
    <h2 class="form-label col-sm-12 text-center" id="nos_articles">Nos Clients</h2>
    <h2 class="form-label col-sm-12 text-center" id="nos_articles">!CONFIDENTIEL!</h2>
    <br> <?php
    $listClients= new ListClients($bdd);
    displayListClients($listClients);

    ?>
</div>



</body>
</html>
