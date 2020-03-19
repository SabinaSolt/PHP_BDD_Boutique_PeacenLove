<?php
include('entete.php');
$arr_inputFields=['clientLastname','clientName','clientAdresse','codePostale','ville'];
$arr_inputClient=[];
$arr_inputErrors=['','','','',''];
$emptyField=0;
// traitement effectué une fois le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // vérifie que tous les champs ont été saisis
    foreach ($arr_inputFields as $index=>$inputField){
        if(!isset($_POST[$inputField])){
            $arr_inputErrors[$index] ='le champ est obligatoire';
            $emptyField++;
        }
    }

   if($emptyField==0) {
       // crée un tableau avec les infos client
       foreach ($arr_inputFields as $index=>$inputField){
           $arr_inputClient[$index] =htmlspecialchars($_POST[$inputField]);
       }
       $_SESSION['currentCustomer'] =$arr_inputClient;
       // Insert le nouveau client dans BD
       $requete=$bdd->prepare("INSERT INTO `client`(`nomClient`, `prenomClient`,
                        `adresse`, `codePostale`, `ville`) VALUES ( ?,?,?,?,? )");
       $requete->execute($arr_inputClient);
       $newCustomerId=$bdd->lastInsertId();

       // Calculer le total de la commande
       $montant=totalPanier($bdd, $_SESSION['basket']);

       // Créer la nouvelle commande
       //incrementer le numero de la commande
       $newIO=incrementIO($bdd);
       $_SESSION['newIO'][0] =$newIO;
       // Cree la commande
       $requete3=$bdd->prepare("INSERT INTO `commande`(`idCommande`, `dateCommande`,`idClient`,idTransporteur,
                            `montantCommande`, fraisTransport, montantAvecTransp)
                            VALUES (?, CURRENT_DATE(),? ,?,?,?,? )");
       $arr_createCustOrd =[$newIO, $newCustomerId, $_SESSION['idTransport'], $montant,$_SESSION['fraisTransport'], $_SESSION['montantAvecTransp']];
       $requete3->execute($arr_createCustOrd);
       // Créer les lignes de la commande
       $requete4=$bdd->prepare("INSERT INTO `produitcommande`(`idCommande`,`idProduit`, `quantiteCommande`)
                        VALUES 	(?, ?, ?)");
        foreach ($_SESSION['basket']->getBasket() as $index=>$quantite) {
        $arr_lineOrder =[ $newIO,$index,$quantite];
        $requete4->execute($arr_lineOrder);
        }
       header("Location:orderSummary.php#phrase_accroche");
       exit;
   }
}
?>
    <div class="container p-3 my-3 border bg-dark text-white rounded ">
        <h2 class="form-label col-sm-12 text-center" id="form_client">Informations clients</h2>
        <br>

             <form  class ="form formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#phrase_accroche" method ="POST" enctype="multipart/form-data">
                 <?php

                 {?>
                 <div class="form-group row container my-3 bg-light text-dark rounded ">
                     <div class="col-sm-6">
                     <label for ="clientLastname">Votre Nom: </label>
                     <input class="col-sm-12 form-control " type="text" name ="clientLastname" maxlength="45" required> <br>
                         <span class="error text-danger"> <?php echo $arr_inputErrors[0] ?></span>
                     </div>
                     <div class="col-sm-6">
                     <label for ="clientName">Votre Prénom: </label>
                     <input class="col-sm-12 form-control" type="text" name ="clientName" maxlength="45" required><br>
                         <span class="error text-danger"> <?php echo $arr_inputErrors[1] ?></span>
                     </div>
                     <div class="col-sm-12">
                     <label for ="clientAdresse">Adresse: </label>
                     <input class="col-sm-12 form-control" type="text" name ="clientAdresse" maxlength="255" required><br>
                         <span class="error text-danger"> <?php echo $arr_inputErrors[2] ?></span>
                     </div>
                     <div class="col-sm-6">
                     <label for ="codePostale">Code postale: </label>
                     <input class="col-sm-12 form-control" type="text" name ="codePostale" maxlength="45" required><br>
                         <span class="error text-danger"> <?php echo $arr_inputErrors[3] ?></span>
                     </div>
                     <div class="col-sm-6">
                     <label for ="codePostale">Ville: </label>
                     <input class="col-sm-12 form-control" type="text" name ="ville" maxlength="45" required><br>
                         <span class="error text-danger"> <?php echo $arr_inputErrors[4] ?></span>
                     </div>


                 </div>
                 <?php

                 } ?>
                 <br>
                    <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>

             </form>
        </div>



     </body>
</html>


