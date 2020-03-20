

<?php

function totalPanier(PDO $p_bdd, Panier $panier) {
    $totalPanier =0;
    $basket=$p_bdd-> prepare("SELECT * FROM produit WHERE idProduit=?");
    foreach($panier->getBasket() as $index=>$quantite) {
        $basket->execute(array($index));
        $item=$basket->fetch();
        $totalPanier = $totalPanier + floatval($item['prix'])*intval($quantite);
    }
    return $totalPanier;
};

function deletePanier () {

}

//incrementer le numero de la commande
function incrementIO($p_bdd) {
    $requete2=$p_bdd->query("SELECT idCommande FROM commande");
    $lastIO=0;
    while($data=$requete2-> fetch()) {
        $rootIO=intval(substr($data['idCommande'],-4));
        if($lastIO==0) {
            $lastIO=$rootIO;
        }
        elseif ($lastIO<$rootIO) {
            $lastIO=$rootIO;
        }
    }
    $newRootIO= $lastIO+1;

    if ($newRootIO<10) {
        $getnewIO='C2020-000'.$newRootIO;
    }
    elseif ($newRootIO<100) {
        $getnewIO='C2020-00'.$newRootIO;
    }
    elseif ($newRootIO<1000) {
        $getnewIO='C2020-0'.$newRootIO;
    }
    return $getnewIO;
}


function displayArticle(Article $item) { ?>
    <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche" method ="POST" enctype="multipart/form-data">

                 <div class="row container my-3 bg-light text-dark rounded ">

                    <div class="col-sm-3"> <img class ="" src =" <?php echo $item->getImage() ?> "alt="image"></div>
                    <div class ="col-sm-2 "><?php echo $item->getNom()?> </div>
                     <div class ="col-sm-4 item-desc "><?php echo $item->getDescription()?> </div>
                     <div class ="col-sm-2 rounded-circle price "> <?php echo $item->getPrix() ?> €</div>
                    <input class="form-control col-sm-1 " type="checkbox" name ="<?php echo 'checkbox'.$item->getIdProduit()?>">

                 </div>
                 <br>
                    <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

             </form>



<?php }

function displayCat (Catalogue $cat) {?>
     <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche"
            method ="POST" enctype="multipart/form-data">
        <?php foreach($cat->getListItem() as $index=>$item) {?>
                 <div class="row container my-3 bg-light text-dark rounded ">

                    <div class="col-sm-3"> <img class ="" src =" <?php echo $item->getImage() ?> "alt="image"></div>
                    <div class ="col-sm-2 "><?php echo $item->getNom()?> </div>
                     <div class ="col-sm-3 item-desc "><?php echo $item->getDescription()?> </div>
                     <?php if(is_a($item,"Chaussure")) {?>
                     <div class ="col-sm-1 item-desc "><?php echo $item->getPointure()?> </div>
                     <?php }
                     elseif(is_a($item,"Vetement")) {?>
                         <div class ="col-sm-1 item-desc "><?php echo $item->getTaille()?> </div>
                     <?php }
                     else{?><div class ="col-sm-1 item-desc "> </div>
                     <?php } ?>
                     <div class ="col-sm-2 mt-2 "> <?php echo $item->getPrix() ?> €</div>
                    <input class="form-control col-sm-1 my-4 " type="checkbox" name ="<?php echo 'checkbox'.$item->getIdProduit()?>">

                 </div>
        <?php } ?>
                 <br>
                    <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

             </form>

   <?php
}

function displayListClients (ListClients $list) {?>
    <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche" method ="POST" enctype="multipart/form-data">
        <?php foreach($list->getListClients() as $index=>$client) {?>
            <div class="row container bg-light text-dark rounded ">

                <div class ="col-sm-1 item-desc"><?php echo $client->getId()?> </div>
                <div class ="col-sm-2 item-desc"><?php echo $client->getPrenom()?> </div>
                <div class ="col-sm-2 item-desc"><?php echo $client->getNom()?> </div>
                <div class ="col-sm-3 item-desc"><?php echo $client->getAdresse()?> </div>
                <div class ="col-sm-1 item-desc"><?php echo $client->getCodePostale()?> </div>
                <div class ="col-sm-3 item-desc"><?php echo $client->getVille()?> </div>
<!--                <input class="form-control col-sm-1 " type="checkbox" name ="--><?php //echo 'checkbox'.$client->getId()?><!--">-->

            </div>
        <?php } ?>
        <br>
<!--        <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>-->

    </form>

    <?php
}?>


<?php function displayPanier(Panier $panier, PDO $bd)
{?>
<!--    <form  class ="form-horizontal m-3  formulaire " action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--#phrase_accroche" method ="POST" enctype="multipart/form-data">-->
        <?php if(!empty($panier)) {
            $requete=$bd-> prepare("SELECT * FROM produit WHERE idProduit=?");
            foreach ($panier->getBasket() as $index => $quantite) {
                $requete->execute(array($index));
                $item=$requete->fetch();
                ?>

                <div class="row my-3 bg-light text-dark rounded ">

                    <div class="col-sm-2"><img class="" src=" <?php echo $item['imageProduit'] ?> "
                                               alt="image"></div>
                    <div class="col-sm-2 "><?php echo $item['nomProduit'] ?> </div>
                    <div class ="col-sm-3 item-desc "><?php echo $item['descriptionProduit']?> </div>
                    <div class="col-sm-2 mt-2 "> <?php echo $item['prix'] ?>
                        €
                    </div>
                    <input class="form-control col-sm-1 mt-2" type="checkbox" style="visibility:hidden" name="<?php echo 'checkbox' . $item['idProduit'] ?>"
                           checked>
                    <div class=" col-sm-2  mt-2"> Quantité: <input class=" col-sm-12 text-center " type="number"
                                                                       name="<?php echo 'quantite' . $index ?>"
                                                                       value="<?php echo $panier->getBasket()[$index] ?>">
                        <span class="error text-danger"> <?php
                            if(isset($_SESSION['arr_error'])) {
                                if(array_key_exists($index, $_SESSION['arr_error'])) {
                                    echo $_SESSION['arr_error'][$index];
                                }
                            }?></span>
                        <button class="btn btn-secondary my-3" type="submit" name="<?php echo 'delete' . $index ?>">
                            Supprimer
                        </button>
                    </div>

                </div>
                <?php
            }
        } ?>
<!--    </form>-->
<?php } ?>


