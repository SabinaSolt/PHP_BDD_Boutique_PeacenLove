<?php
include('entete.php');
var_dump($_SESSION);
unset($_SESSION['id_trasp']);
echo '<div class="container p-3 my-3 border bg-dark text-white text-center font-weight-bold rounded"
        style="font-size:30px;">'. 'Votre commande a été passée. Le numéro de votre commande: '.$_SESSION['newIO'][0] .'</div>';
//var_dump($_SESSION);
?>
<form  class ="form-horizontal formulaire " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
       method ="POST" enctype="multipart/form-data">
<div class="container p-3 my-3 border bg-dark text-white rounded ">
    <h2 class="form-label col-sm-12 text-center font-weight-bold">Récapitulatif de votre commande: </h2>
    <br>
    <div class="row container p-3  my-3 bg-light text-dark rounded text-left ">
        <div class="col-sm-12 font-weight-bold">Information client:</div>
        <div class="col-sm-12 "> <?php echo $_SESSION['currentCustomer'][0].' '.$_SESSION['currentCustomer'][1]?></div><br>
        <div class ="col-sm-12  "><?php echo $_SESSION['currentCustomer'][2]?> </div><br>
        <div class ="col-sm-12 "><?php echo $_SESSION['currentCustomer'][3].' '.$_SESSION['currentCustomer'][4]?> </div>

    </div>


        <?php
        $requete5=$bdd->prepare("SELECT produit.nomProduit, produit.imageProduit, 
                        produitcommande.quantiteCommande, produit.prix as 'prixUnit' 
                        FROM `produitcommande` 
                        INNER JOIN produit ON produitcommande.idProduit=produit.idProduit 
                        WHERE `idCommande`=:numCommande");
        $requete5->bindParam(':numCommande',$_SESSION['newIO'][0]);
        $requete5->execute();
        while($orderItem = $requete5->fetch())
        {?>
            <div class="row container  my-3 bg-light text-dark rounded ">

                <div class="col-sm-3"> <img class ="" src =" <?php echo $orderItem['imageProduit'] ?> "alt="image"></div>
                <div class ="col-sm-2 "><?php echo $orderItem['nomProduit']?> </div>
                <div class ="col-sm-2  "><?php echo $orderItem['quantiteCommande']?> </div>
                <div class ="col-sm-2 "> <?php echo $orderItem['prixUnit'] ?> €</div>
                <div class ="col-sm-2 "> <?php echo number_format($orderItem['prixUnit']*$orderItem['quantiteCommande'],2) ?> €</div>
            </div>
            <?php

        }
        $requete6=$bdd->prepare("SELECT montantCommande FROM commande WHERE idCommande=:numCommande");
        $requete6->bindParam(':numCommande',$_SESSION['newIO'][0]);
        $requete6->execute();
        $totalCommande=$requete6->fetchColumn();
        echo '<div class="row my-3 bg-light text-dark rounded">
                    <div class="btn-group-vertical m-3 "> 
                        <div class=" row sous-total container  bg-light text-dark rounded mb-3 " > Total: ',
                        $totalCommande, ' €</div>';
            ?>
                        <div class="row sous-total container bg-light text-dark rounded mb-3 ">
                            Frais de Livraison: <?=  $_SESSION['fraisTransport']?>€
                        </div>
                        <div class="row sous-total container bg-light text-dark rounded mb-3 ">
                            Total
                            Commande: <?= $_SESSION['montantAvecTransp']?>
                            €
                        </div>
                    </div>
                </div>
    </form>
</div>
</body>
</html>
