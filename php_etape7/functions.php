

<?php


function afficheArticle1() {
    $arr_item_name=["Jupe", "Foulard", "Chemise"];
    $arr_item_price=[25.90,10.90,30.90];
    $arr_item_photo=["images/jupe.jpg","images/foulard.jpg","images/chemise.jpg"];
    echo '<td class="col-sm-3 article-carte"> <img src =',$arr_item_photo[0], '></td>',
    '<td class="col-sm-7">', $arr_item_name[0],'</td>' ."\n" ,
    '<td class="col-sm-2">', $arr_item_price[0] ." €\n" ,'</td>', '<br>';
};
function afficheArticle2() {
    $arr_item_name=["Jupe", "Foulard", "Chemise"];
    $arr_item_price=[25.90,10.90,30.90];
    $arr_item_photo=["images/jupe.jpg","images/foulard.jpg","images/chemise.jpg"];
    echo '<td class="col-sm-3 article-carte"> <img src =',$arr_item_photo[1], '></td>',
    '<td class="col-sm-7">', $arr_item_name[1],'</td>' ."\n" ,
    '<td class="col-sm-2">', $arr_item_price[1] ." €\n" ,'</td>', '<br>';
};
function afficheArticle3() {
    $arr_item_name=["Jupe", "Foulard", "Chemise"];
    $arr_item_price=[25.90,10.90,30.90];
    $arr_item_photo=["images/jupe.jpg","images/foulard.jpg","images/chemise.jpg"];
    echo '<td class="col-sm-3 article-carte"> <img src =',$arr_item_photo[2], '></td>',
    '<td class="col-sm-7">', $arr_item_name[2],'</td>' ."\n" ,
    '<td class="col-sm-2">', $arr_item_price[2] ." €\n" ,'</td>', '<br>';
};

function afficheArticle($p_item_name, $p_item_price, $p_item_photo) {
    echo '<td class="col-sm-3 article-carte"> <img src =',$p_item_photo, '></td>',
    '<td class="col-sm-7">', $p_item_name,'</td>' ."\n" ,
    '<td class="col-sm-2">', $p_item_price ." €\n" ,'</td>', '<br>';
};

?>


