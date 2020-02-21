<?php include('entete.php'); ?>
       <?php
       $arr_checkbox = [];
       $_SESSION['checkBoxes'] = [];

        // traitement effectué une fois le formulaire est soumis

        if ($_SERVER["REQUEST_METHOD"] == "POST") //Vérifie que le formulaire a été posté
        {
            while ($item = $catalog->fetch()) {
                $nomCheckbox = 'checkbox' . $item['idProduit'];
                if (isset($_POST[$nomCheckbox])) {
                   array_push($arr_checkbox, $item['idProduit']); // stocke l'index de l'article choisi dans catalogue

                }
            }
                $_SESSION['checkBoxes'] = $arr_checkbox;

               header("Location:panier.php#phrase_accroche");
               exit;
        }
        ?>

    <div class="container p-3 my-3 border bg-dark text-white rounded ">
        <h2 class="form-label col-sm-12 text-center" id="nos_articles">Nos articles</h2>
        <br>

             <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche" method ="POST" enctype="multipart/form-data">
                 <?php
                  while($item = $catalog->fetch())
                 {?>
                 <div class="row container my-3 bg-light text-dark rounded ">

                    <div class="col-sm-3"> <img class ="" src =" <?php echo $item['imageProduit'] ?> "alt="image"></div>
                    <div class ="col-sm-2 "><?php echo $item['nomProduit']?> </div>
                     <div class ="col-sm-4 item-desc "><?php echo $item['descriptionProduit']?> </div>
                     <div class ="col-sm-2 rounded-circle price "> <?php echo $item['prix'] ?> €</div>
                    <input class="form-control col-sm-1 " type="checkbox" name ="<?php echo 'checkbox'.$item['idProduit']?>">

                 </div>
                 <?php

                 } ?>
                 <br>
                    <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

             </form>
        </div>



     </body>
</html>
