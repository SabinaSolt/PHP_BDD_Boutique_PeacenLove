

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
?>


