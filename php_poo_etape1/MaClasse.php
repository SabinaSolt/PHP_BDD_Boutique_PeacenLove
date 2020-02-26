<?php

class Catalogue
{
    private $_arr_items = [];


    public function __construct(PDO $db)
    {
        // retourne la liste de tous les produits y compris chaussures et vetements

        $q = $db->query("SELECT nomProduit, descriptionProduit, prix, imageProduit,
                        poids, quantiteStock, disponible, produit.idProduit, idCategorieProduit
                         FROM produit");

        while ($d = $q->fetch(PDO:: FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array
        {
            if (isset($d['pointure'])) {
                $item = new Chaussure();
                $item->setId($d['id']);
                $item->setPointure($d['pointure']);
            } elseif (isset($d['taille'])) {
                $item = new Vetement();
                $item->setId($d['id']);
                $item->setTaille($d['taille']);
            } else {
                $item = new Article();
            }

            $item->setNom($d['nomProduit']);
            $item->setDescription($d['descriptionProduit']);
            $item->setPrix($d['prix']);
            $item->setImage($d['imageProduit']);
            $item->setPoids($d['poids']);
            $item->setStock($d['quantiteStock']);
            $item->setDisponible($d['disponible']);
            $item->setIdProduit($d['idProduit']);
            $item->setCategorie($d['idCategorieProduit']);

            $this->_arr_items[] = $item;
        }

    }

    public function addItem(Article $item)
    {
        $this->_arr_items[] = $item;
    }

    public function getListItem()
    {
        return $this->_arr_items;
    }
}


class Article
{
    private $_nom;
    private $_description;
    private $_prix;
    private $_image;
    private $_poids;
    private $_stock;
    private $_disponible;
    private $_idProduit;
    private $_categorie;


    public function getNom()
    {
        return $this->_nom;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getPrix()
    {
        return $this->_prix;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function getPoids()
    {
        return $this->_poids;
    }

    public function getStock()
    {
        return $this->_stock;
    }

    public function getDisponible()
    {
        return $this->_disponible;
    }

    public function getIdProduit()
    {
        return $this->_idProduit;
    }

    public function getCategorie()
    {
        return $this->_categorie;
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }

    }

    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->_description = $description;
        }
    }

    public function setPrix($prix)
    {
        if ($prix > 0) {
            $this->_prix = $prix;
        }
    }

    public function setImage($image)
    {
        if (is_string($image)) {
            $this->_image = $image;
        }
    }

    public function setPoids($poids)
    {
        $poids = (int)$poids;
        if ($poids > 0) {
            $this->_poids = $poids;
        }
    }

    public function setStock($stock)
    {
        $stock = (int)$stock;
        if ($stock >= 0) {
            $this->_stock = $stock;
        }
    }

    public function setDisponible($dispo)
    {

        $this->_disponible = $dispo;

    }

    public function setIdProduit($id)
    {

        if (($id)) {
            $this->_idProduit = $id;
        }
    }

    public function setCategorie($cat)
    {
        if (($cat)) {
            $this->_categorie = $cat;
        }
    }
}

class Chaussure extends Article
{
    private $_pointure;
    private $_id;

    public function getPointure()
    {
        return $this->_pointure;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setPointure($pointure)
    {
        if (isset($pointure)) {
            $this->_pointure = $pointure;
        }
    }

    public function setId($id)
    {
        if (isset($id)) {
            $this->_id = $id;
        }
    }
}

class Vetement extends Article
{
    private $_taille;
    private $_id;

    public function getTaille()
    {
        return $this->_taille;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setTaille($taille)
    {
        if (isset($taille)) {
            $this->_taille = $taille;
        }
    }

    public function setId($id)
    {
        if (isset($id)) {
            $this->_id = $id;
        }
    }
}

class ListClients
{
    private $_arr_clients = [];


    public function __construct(PDO $db)
    {
        // retourne la liste de tous les produits

        $q = $db->query("SELECT idClient, nomClient, prenomClient, adresse, codePostale, ville FROM client");

        while ($d = $q->fetch(PDO:: FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array
        {

            $client = new Client();
            $client->setNom($d['nomClient']);
            $client->setId($d['idClient']);
            $client->setPrenom($d['prenomClient']);
            $client->setAdresse($d['adresse']);
            $client->setCodePostale($d['codePostale']);
            $client->setVille($d['ville']);


            $this->_arr_clients[] = $client;
        }
    }

    public function addClient(Client $client)
    {
        $this->_arr_clients[] = $client;
    }

    public function getListClients()
    {
        return $this->_arr_clients;
    }
}

class Client
{
    private $_id;
    private $_nom;
    private $_prenom;
    private $_adresse;
    private $_codePostale;
    private $_ville;

    public function getNom()
    {
        return $this->_nom;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function getAdresse()
    {
        return $this->_adresse;
    }

    public function getCodePostale()
    {
        return $this->_codePostale;
    }

    public function getVille()
    {
        return $this->_ville;
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }

    public function setAdresse($adresse)
    {
        $this->_adresse = $adresse;
    }

    public function setCodePostale($codePostale)
    {
        $this->_codePostale = $codePostale;
    }

    public function setVille($ville)
    {
        $this->_ville = $ville;
    }
}

class Panier
{
    private $_basket = [];

    public function getBasket()
    {
        $this->_basket;
    }

    public function setBasket(array $arr)
    {
        $this->_basket = $arr;
    }

    public function addItemBasket($id)
    {
        if(array_key_exists($id, $this->_basket))
        {
            $this->_basket[$id]++;
        }
        else
        {
            $this->_basket[$id]=1;
        }
    }

    public function updateBasket($id, $quantite)
    {
        $quantite=(int)$quantite;

        if(array_key_exists($id, $this->_basket))
        {
            $this->_basket[$id]=$this->_basket[$id]+$quantite;
        }
        else
        {
            $this->_basket[$id]=$quantite;
        }
    }

    public function deleteItemBasket($id)
    {
        if(array_key_exists($id, $this->_basket))
        {
           unset($this->_basket[$id]);
        }
    }
}

?>