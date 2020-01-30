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
     <?php include ("functions.php"); ?>

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
                        $arr_catalogue = [
                          ["Jupe",25.90,"images/jupe.jpg"],
                          ["Foulard",10.90,"images/foulard.jpg"],
                          ["Chemise",30.90,"images/chemise.jpg"]
                        ];

                         for ($i=0; $i<count($arr_catalogue);$i=$i+1) {
                             afficheArticle($arr_catalogue[$i][0],$arr_catalogue[$i][1],$arr_catalogue[$i][2]);
                         }

                         ?>
                    </tr>
                 </tbody>
            </table>
         </div>
     </body>
</html>
