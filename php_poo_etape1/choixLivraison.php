<?php
include('entete.php');

// le formulaire renvoie sur lui-même ou sur une autre page selon si il a déjà été soumis ou pas
if (isset($_POST['optionLivr']) AND isset($_SESSION['frais_livr'])) {
    $pageAffiche="customerInfo.php#phrase_accroche";
    $message="Cliquez sur \"Confirmer\" pour passer la commande";
} else {
    $pageAffiche = htmlspecialchars($_SERVER["PHP_SELF"]).'#phrase_accroche';
    $message="Choisissez le mode de livraison et cliquez sur \"Confirmer\" pour continuer";
}
?>
<form class="form-horizontal formulaire " action="<?php echo $pageAffiche; ?>"
      method="POST" enctype="multipart/form-data">
    <div class="container p-3 my-3 border bg-dark text-white rounded ">
        <h2 class="form-label col-sm-12 text-center font-weight-bold" id="choix_livr"> Choix de livraison: </h2>

        <?php
        // Afficher les articles du panier
        $requete5 = $bdd->prepare("SELECT produit.nomProduit, produit.imageProduit, 
                         produit.prix as 'prixUnit', produit.poids 
                        FROM `produit` 
                        WHERE `idProduit`=:idItem");
        $poids = 0;
        foreach ($_SESSION['checkBoxes'] as $index => $idItem) {
            $requete5->bindParam(':idItem', $idItem);
            $requete5->execute();

            while ($orderItem = $requete5->fetch()) {
                ?>
                <div class="row container  my-3 bg-light text-dark rounded ">

                    <div class="col-sm-3"><img class="" src=" <?php echo $orderItem['imageProduit'] ?> " alt="image">
                    </div>
                    <div class="col-sm-2 "><?php echo $orderItem['nomProduit'] ?> </div>
                    <div class="col-sm-1  "><?php echo $_SESSION['quantite'][$index] ?> </div>
                    <div
                        class="col-sm-2 "><?php echo number_format($orderItem['poids'] * $_SESSION['quantite'][$index] / 1000, 2) ?>
                        kg
                    </div>
                    <div class="col-sm-2 "> <?php echo $orderItem['prixUnit'] ?> €</div>
                    <div
                        class="col-sm-2 "> <?php echo number_format($orderItem['prixUnit'] *$_SESSION['quantite'][$index], 2) ?>
                        €
                    </div>
                </div>
                <?php
                //calcule le poids total de la commande
                $poids = $poids + ($orderItem['poids'] * $_SESSION['quantite'][$index] / 1000);
            }
        }

        //calcule le total de la commande avant les frais de livraison
        $totalCommande = totalPanier($bdd, $_SESSION['checkBoxes'], $_SESSION['quantite']);

        echo '<div class ="row container ">';

        if(!isset($_POST['optionLivr'])) {
        // Afficher le block avec les frais de la livraison suivie
            echo '<div class="btn-group-vertical m-3 row col-sm-6">
                    <label class="m-3" >Avec suivi</label>';
            $requete7 = $bdd->prepare("SELECT id, nomTransporteur, tarifs_suivi.idTransporteur, poids_min, poids_max, `typeTarif`, tarif 
                                FROM tarifs_suivi 
                                INNER JOIN transporteur ON transporteur.idTransporteur=tarifs_suivi.idTransporteur");
            $requete7->execute();
            $indexFraisLivr = 0;
            $id_transp = [];
            $frais_livr = [];

            while ($tarifs = $requete7->fetch()) {
                if ($tarifs['typeTarif'] == 'montant_fixe') {
                $id_transp[$indexFraisLivr] = $tarifs['idTransporteur'];
                $frais_livr[$indexFraisLivr] = number_format($tarifs['tarif'], 2);
                ?>
                    <div class=" row col-sm-6">
                        <label class="input-group-text"
                               for="optionLivr"> <?php echo $tarifs['nomTransporteur'] . ": " . $frais_livr[$indexFraisLivr] . " €" ?></label>
                        <input class="m-3" type="radio" name="optionLivr" value="<?php echo $indexFraisLivr ?>"
                               id="optionLivr"/>
                    </div>
                    <?php
                    $indexFraisLivr++;
                    } elseif ($poids >= $tarifs['poids_min'] and $poids <= $tarifs['poids_max']) {
                        $id_transp[$indexFraisLivr] = $tarifs['idTransporteur'];
                        $frais_livr[$indexFraisLivr] = number_format(($tarifs['tarif'] * 1000 * $poids), 2);
                        ?>
                        <div class="row col-sm-6">
                            <label class="input-group-text"
                                   for="optionLivr"> <?php echo $tarifs['nomTransporteur'] . ": " . $frais_livr[$indexFraisLivr] . " €" ?></label>
                            <input class="m-3" type="radio" name="optionLivr" value="<?php echo $indexFraisLivr ?>"
                                   id="optionLivr"/>
                        </div>
                        <?php
                        $indexFraisLivr++;
                    }
                }
                ?>
            </div>

            <?php
            // Afficher le block avec frais de livraison sans suivi
            if ($totalCommande <= 20) {
                echo ' <div class="btn-group-vertical m-3 row col-sm-6">
                <label class="m-3" >Sans suivi</label>';
                $requete8 = $bdd->prepare("SELECT id, nomTransporteur, tarifs_no_suivi.idTransporteur, poids_min, poids_max, tarif 
                                FROM tarifs_no_suivi 
                                INNER JOIN transporteur ON transporteur.idTransporteur=tarifs_no_suivi.idTransporteur");
                $requete8->execute();
                while ($tarifs = $requete8->fetch()) {
                   if ($poids >= $tarifs['poids_min'] and $poids <= $tarifs['poids_max']) {
                       $id_transp[$indexFraisLivr] = $tarifs['idTransporteur'];
                       $frais_livr[$indexFraisLivr] = number_format($tarifs['tarif'], 2);
                        ?>
                        <div class="row col-sm-6">
                            <label class="input-group-text"
                                   for="optionLivr"> <?php echo $tarifs['nomTransporteur'] . ": " . $frais_livr[$indexFraisLivr] . " €" ?></label>
                            <input class="m-3" type="radio" name="optionLivr" value="<?php echo $indexFraisLivr?>" id="optionLivr" />
                        </div>
                        <?php
                       $indexFraisLivr++;
                    }
                }
            }
            $_SESSION['frais_livr'] =$frais_livr;
            $_SESSION['id_transp'] =$id_transp;
            }
            ?>
    </div>
<!--     affiche les sous totaux-->
        <div class="btn-group-vertical m-3 ">
            <div class=" row sous-total container  bg-light text-dark rounded mb-3 " >
                Poids total: <?=$poids?> kg</div>
            <div class=" row sous-total container bg-light text-dark rounded mb-3 " >
                Total sans Livraison: <?= number_format($totalCommande,2)?> €</div>
        <?php

        if (isset($_POST['optionLivr']) AND isset($_SESSION['frais_livr'])) {
            // stocke les valeurs recuperées en variables $_SESSION
            $_SESSION['fraisTransport']= $_SESSION['frais_livr'][$_POST['optionLivr']];
            $_SESSION['idTransport'] = $_SESSION['id_transp'][$_POST['optionLivr']];
            $_SESSION['montantAvecTransp'] = number_format(($_SESSION['fraisTransport'] + $totalCommande), 2);
            ?>

<!--             affiche les sous-totax liés à la livraison, si le calcul a été fait-->
            <div class="row sous-total container bg-light text-dark rounded mb-3 ">
                Frais de Livraison: <?= $_SESSION['fraisTransport'] ?>€
            </div>
            <div class="row sous-total container bg-light text-dark rounded mb-3 ">
                Total Commande: <?=  $_SESSION['montantAvecTransp'] ?>
                €
            </div>
        </div>
        <?php
        }
        ?>

        <div class="mx-auto "><p><?= $message?></p>
        <button class="btn btn-primary" type="submit" name="buttonSubmit"> Confirmer</button></div>
</form>
</div>
</body>
</html>

