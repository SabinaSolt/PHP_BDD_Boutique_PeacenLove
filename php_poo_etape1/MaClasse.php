<?php
class Catalogue {
    private $_arr_items=[];


    public function __construct(PDO $db) {
        // retourne la liste de tous les produits

        $q=$db->query("SELECT nomProduit, descriptionProduit, prix, imageProduit,
                poids, quantiteStock, disponible, idProduit, idCategorieProduit FROM produit");

        while ($d=$q->fetch(PDO:: FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array
        {
           // $item = new Article($donnees);
            $item=new Article();
            $item->setNom($d['nomProduit']);
            $item->setDescription($d['descriptionProduit']);
            $item->setPrix($d['prix']);
            $item->setImage($d['imageProduit']);
            $item->setPoids($d['poids']);
            $item->setStock($d['quantiteStock']);
            $item->setDisponible($d['disponible']);
            $item->setIdProduit($d['idProduit']);
            $item->setCategorie($d['idCategorieProduit']);

            $this->_arr_items[]=$item;
        }
    }

    public function addItem (Article $item) {
        $this->_arr_items[]=$item;
    }

    public function getListItem() {
        return $this->_arr_items;
    }
}


class Article {
private $_nom;
private $_description;
private $_prix;
private $_image;
private $_poids;
private $_stock;
private $_disponible;
private $_idProduit;
private $_categorie;


    public function getNom() {
        return $this->_nom;
    }
    public function getDescription() {
        return $this->_description;
    }
    public function getPrix() {
        return $this->_prix;
    }
    public function getImage() {
        return $this->_image;
    }
    public function getPoids() {
        return $this->_poids;
    }
    public function getStock() {
        return $this->_stock;
    }
    public function getDisponible() {
        return $this->_disponible;
    }
    public function getIdProduit() {
        return $this->_idProduit;
    }
    public function getCategorie() {
        return $this->_categorie;
    }

    public function setNom($nom) {
        if(is_string($nom)) {
            $this->_nom=$nom;
        }
    }
    public function setDescription($description) {
        if(is_string($description)) {
            $this->_description=$description;
        }
    }
    public function setPrix($prix) {
        if($prix>0) {
            $this->_prix=$prix;
        }
    }
    public function setImage($image) {
        if(is_string($image)) {
            $this->_image=$image;
        }
    }
    public function setPoids($poids) {
        $poids=(int) $poids;
        if($poids>0) {
            $this->_poids=$poids;
        }
    }
    public function setStock($stock) {
        $stock=(int)$stock;
        if($stock >=0) {
            $this->_stock=$stock;
        }
    }
    public function setDisponible($dispo) {

            $this->_disponible=$dispo;

    }
    public function setIdProduit($id) {

        if(($id)) {
            $this->_idProduit=$id;
        }
    }
    public function setCategorie($cat) {
      if(($cat)) {
          $this->_categorie=$cat;
      }
    }


}





?>