<?php
include('entete.php');

echo '<div class="container p-3 my-3 border bg-dark text-white text-center font-weight-bold rounded"
        style="font-size:30px;">'. 'Votre commande a été passée. Le numéro de votre commande: '.$_SESSION['newIO'][0] .'</div>';
var_dump($_SESSION);
?>

<div class="container p-3 my-3 border bg-dark text-white rounded ">
    <h2 class="form-label col-sm-12 text-center font-weight-bold">Récapitulatif de votre commande: </h2>
    <br>
    <div class="row container p-3  my-3 bg-light text-dark rounded ">
        <div class="col-sm-12 font-weight-bold">Information client:</div>
        <div class="col-sm-12"> <?php echo $_SESSION['currentCustomer'][0].' '.$_SESSION['currentCustomer'][1]?></div><br>
        <div class ="col-sm-12  "><?php echo $_SESSION['currentCustomer'][2]?> </div><br>
        <div class ="col-sm-12 "><?php echo $_SESSION['currentCustomer'][3].' '.$_SESSION['currentCustomer'][4]?> </div>

    </div>


    <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" enctype="multipart/form-data">
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
