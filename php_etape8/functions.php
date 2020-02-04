

<?php

function totalPanier($p_arr_catalogue, $p_arr_checkboxes, $p_arr_quantite) {
    $totalPanier =0;
    foreach($p_arr_checkboxes as $index=>$p_checkbox) {
        $totalPanier = $totalPanier + floatval($p_arr_catalogue[$p_checkbox][1])*intval($p_arr_quantite[$index]);
    }
    return $totalPanier;
};

function deletePanier () {
    $_SESSION['checkBoxes'] = [];
}

?>


