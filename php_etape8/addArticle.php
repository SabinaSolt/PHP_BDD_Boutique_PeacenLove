<?php include('entete.php'); ?>
       <?php
       $arr_checkbox = [];
       $_SESSION['checkBoxes'] = [];


        // traitement effectué une fois le formulaire est soumis

        if ($_SERVER["REQUEST_METHOD"] == "POST") //Vérifie que le formulaire a été posté
        {
            foreach ($arr_catalogue as $index => $articleCatalogue) {
                $nomCheckbox = 'checkbox' . $index;
                if (isset($_POST[$nomCheckbox])) {
                   array_push($arr_checkbox, $index); // stocke index de l'article choisi dans catalogue

                }
            }
                $_SESSION['checkBoxes'] = $arr_checkbox;

               header("Location:http://localhost/tests_Sabina/PHP_Sabina/php_etape8/panier.php");
               exit;
        }
        ?>

    <div class="container p-3 my-3 border bg-dark text-white rounded ">
        <h2 class="form-label col-sm-12 text-center">Nos articles</h2>
        <br>

             <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" enctype="multipart/form-data">
                 <?php foreach($arr_catalogue as $index=>$articleCatalogue) {?>
                 <div class="row container my-3 bg-light text-dark rounded ">
                   
                    <div class="col-sm-3"> <img class ="" src =" <?php echo $articleCatalogue[2] ?> "alt="image"></div>
                    <div class ="col-sm-5 "><?php echo $articleCatalogue[0]?> </div>
                     <div class ="col-sm-2 rounded-circle price "> <?php echo $articleCatalogue[1] ?> €</div>
                    <input class="form-control col-sm-2 " type="checkbox" name ="<?php echo 'checkbox'.$index?>">

                 </div>
                 <?php } ?>
                 <br>
                    <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

             </form>
        </div>



     </body>
</html>
