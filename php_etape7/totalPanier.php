

<?php

function totalPanier($p_arr_catalogue, $p_arr_checkboxes, $p_arr_quantite) {
    $totalPanier =0;
    foreach($p_arr_checkboxes as $index=>$p_checkbox) {
        if($p_checkbox==1) {
            $totalPanier = $totalPanier + floatval($p_arr_catalogue[$index][1])*intval($p_arr_quantite[$index]);
        }
    }
    return $totalPanier;

};



function deleteItem($p_index) {
    $_SESSION['checkBoxes'] [$p_index] =0;

}
?>


