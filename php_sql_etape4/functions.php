<?php
function itemsSoldout($p_bdd, $p_table,$p_champTeste) {
    $requete=$p_bdd->prepare("SELECT * FROM $p_table  WHERE $p_champTeste = 10");
    $requete->execute();
    while ($donnees=$requete->fetch())
    {
        echo '<p>'.$donnees['nomProduit'].'</p>';
    }
}

function recentOrders($p_bdd) {
    $reponse=$p_bdd->query("SELECT `idCommande` 
    FROM `commande`
    WHERE `dateCommande`> DATE_SUB(CURRENT_DATE(), INTERVAL 10 DAY) 
    ORDER BY `idCommande` DESC
    ");
    while ($donnees=$reponse->fetch())
    {
        echo '<p>'.$donnees['idCommande'].'</p>';
    }
}
 function ordersTotal($p_bdd) {
     $requete=$p_bdd->prepare("SELECT produitcommande.idCommande, 
        SUM(produitcommande.quantiteCommande*produit.prix) AS 'PrixTotal' 
        FROM `produitcommande` 
        INNER JOIN produit ON produitcommande.idProduit=produit.idProduit 
        GROUP BY produitcommande.idCommande
        
        ");
     $requete->execute();
     while ($donnees=$requete->fetch())
     {
         echo '<p>'.$donnees['idCommande'].' = '.$donnees['PrixTotal'].' € </p>';
     }
 }

function customerTotal($p_bdd) {
    $requete=$p_bdd->prepare("SELECT `client`.`idClient`, `client`.`prenomClient`, `client`.`nomClient`, 
        COUNT(`idCommande`) AS 'Nombre Commandes', SUM(`montantCommande`) AS 'total' 
        FROM `commande` 
        INNER JOIN `client` ON `client`.`idClient`=`commande`.`idClient` 
        GROUP BY `client`.`idClient`");
    $requete->execute();
    while ($donnees=$requete->fetch())
    {
        echo '<p>'.$donnees['prenomClient'].' '.$donnees['nomClient'].'  '.$donnees['total'].' € </p>';
    }
}

function addItem($p_bdd,$p_arr_item) {
    $requete=$p_bdd->prepare("INSERT INTO `produit`(`nomProduit`, `descriptionProduit`,
    `imageProduit`, `poids`, `quantiteStock`, `disponible`, `prix`, `idCategorieProduit`) 
    VALUES ( ?,?,?,?,?,?,?,? )
    ");
    $requete->execute(array_values($p_arr_item));
    echo '<p> new item has been created: '.$p_arr_item[0].' </p>';
}

function deleteItem($p_bdd,$p_idProduit) {
    $requete=$p_bdd->prepare("DELETE FROM `produit` WHERE `idProduit`=?;");
    $requete->execute(array($p_idProduit));
    echo '<p> the item has been deleted: '.$p_idProduit.' </p>';
 }
?>