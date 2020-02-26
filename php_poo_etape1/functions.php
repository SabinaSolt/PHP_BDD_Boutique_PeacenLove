

<?php

function totalPanier($p_bdd, $p_arr_checkboxes, $p_arr_quantite) {
    $totalPanier =0;
    $basket=$p_bdd-> prepare("SELECT * FROM produit WHERE idProduit=?");
    foreach($p_arr_checkboxes as $index=>$p_checkbox) {
        $basket->execute(array($p_checkbox));
        $item=$basket->fetch();
        $totalPanier = $totalPanier + floatval($item['prix'])*intval($p_arr_quantite[$index]);
    }
    return $totalPanier;
};

function deletePanier () {
    $_SESSION['checkBoxes'] = [];
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
     <form  class ="form-horizontal formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche" method ="POST" enctype="multipart/form-data">
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
                     <div class ="col-sm-2 rounded-circle price "> <?php echo $item->getPrix() ?> €</div>
                    <input class="form-control col-sm-1 " type="checkbox" name ="<?php echo 'checkbox'.$item->getId()?>">

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
        <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

    </form>

    <?php
}
?>


