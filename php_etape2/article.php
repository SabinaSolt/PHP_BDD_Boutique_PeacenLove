<!DOCTYPE html>
<html>
    <head>
        <title> Boutique de Sabina </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
     </head>
     <body>
        <header class="hero" >
            <h2 class ="titre_catalogue"> Boutique de Sabina </h2>
            <p > Vous voulez en avoir plein les yeux? Votre porte-monnaie pèse trop lourd? Alors venez faire un tour dans mon e-boutique -
             le meilleur magasin en ligne du prêt-à-porter dans tout Apprieu!</p>
        </header>
        <div class="separation"></div>
        <div class="col-sm-10 item_list container">
            <table class="table table-striped">
                 <thead class="thead-dark">
                    <tr class="row carte-tableau-ligne">
                        <th class="col-sm-12 table-title">Nos articles</th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr class="row carte-tableau-ligne">

                         <?php

                         $arr_item_name=["Jupe", "Foulard", "Chemise"];
                         $arr_item_price=[25.90,10.90,30.90];
                         $arr_item_photo=["images/jupe.jpg","images/foulard.jpg","images/chemise.jpg"];

                         for ($i=0;$i<count($arr_item_name);$i=$i+1) {
                         echo '<td class="col-sm-3 article-carte"> <img src =',$arr_item_photo[$i], '></td>',
                          '<td class="col-sm-7">', $arr_item_name[$i],'</td>' ."\n" ,
                           '<td class="col-sm-2">', $arr_item_price[$i] ." €\n" ,'</td>', '<br>';
                         };

                         ?>
                    </tr>
                 </tbody>
            </table>
         </div>
     </body>
</html>
