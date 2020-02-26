<?php include('entete.php'); ?>
       <?php
       $catalogueArticles= new Catalogue($bdd);
       $_SESSION['basket'] = [];

        // traitement effectué une fois le formulaire est soumis

        if ($_SERVER["REQUEST_METHOD"] == "POST") //Vérifie que le formulaire a été posté
        {
            $basket= new Panier();
            foreach ($catalogueArticles->getListItem() as $index=>$item) {

                $nomCheckbox = 'checkbox' . $item->getIdProduit();

                if (isset($_POST[$nomCheckbox])) {

                    // stocke l'index de l'article choisi dans catalogue
                    $basket->addItemBasket($item->getIdProduit());
                }
            }
                $_SESSION['basket'] = $basket;
                var_dump($basket);
               header("Location:panier.php#phrase_accroche");
               exit;
        }
        ?>

    <div class="container p-3 my-3 border bg-dark text-white rounded ">
        <h2 class="form-label col-sm-12 text-center" id="nos_articles">Nos articles</h2>
        <br> <?php

        //var_dump($catalogueArticles);
        displayCat($catalogueArticles);

        ?>
        </div>



     </body>
</html>
