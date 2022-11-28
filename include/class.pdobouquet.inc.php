<?php

/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoBouquet qui contiendra l'unique instance de la classe
 
 * @package default
 * @author PG
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoBouquet
{
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=miniblog';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoBouquet = null;
    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoBouquet::$monPdo = new PDO(PdoBouquet::$serveur . ';' . PdoBouquet::$bdd, PdoBouquet::$user, PdoBouquet::$mdp);
        PdoBouquet::$monPdo->query("SET CHARACTER SET utf8");
    }
    public function _destruct()
    {
        PdoBouquet::$monPdo = null;
    }
    /**
     * Fonction statique qui crée l'unique instance de la classe 
     * Appel : $instancePdoBouquet = PdoBouquet::getPdoBouquet();
     * @return l'unique objet de la classe PdoBouquet
     */
    public static function getPdoBouquet()
    {
        if (PdoBouquet::$monPdoBouquet == null) {
            PdoBouquet::$monPdoBouquet = new PdoBouquet();
        }
        return PdoBouquet::$monPdoBouquet;
    }

    //================PARTIE PUBLIQUE ==============================================
    /** 
     * Retourne tous les id et libellé de la table Categorie
     * @return un tableau associatif
     */
    public function getLesCategories()
    {
        $res = PdoBouquet::$monPdo->query("select * from categorie");   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;
    }

    /**
     * Retourne la liste de tous les produits sous la forme d'un tableau associatif 
     * @return un tableau associatif
     */

    public function getTousLesProduits()
    {
        $res = PdoBouquet::$monPdo->query("select * from produit");   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;
    }
    /**
     * Retourne la liste des produits d'une categorie sous la forme d'un tableau associatif 
     * @param la categorie souhaitée $idCategorie
     * @return un tableau associatif 
     */
    public function getLesProduitsCategorie($idCategorie)
    {
        $res = PdoBouquet::$monPdo->query("select * from produit where idCategorie='$idCategorie'");   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;
    }


    //================CONNEXION ==============================================

    /**
     * Retourne le nom et le statut d'un utilisateur
     * @param $login 
     * @param $mdp
     * @return le nom et le statut sous la forme d'un tableau associatif
     */
    public function getInfosUtilisateur($login, $mdp)
    {

        $mdp = $mdp;
        $req = "select utilisateur.nom as nom, utilisateur.statut as statut from utilisateur
        where login='$login' and mdp='$mdp'";
        $res = PdoBouquet::$monPdo->query($req);
        $ligne = $res->fetch();
        return $ligne;
    }

    public function getLeslogin()
    {

        $res = PdoBouquet::$monPdo->query("select * from utilisateur where statut='client' ");
        $lesLogin = array();
        $lesLogin = $res->fetchAll();
        return $lesLogin;
    }


    //================PARTIE 3 ADMIN GERER PRODUIT ==============================      

    /**
     * Supprime le produit id dans la base de données
     * @param $id
     * @return le nombre de ligne affectée (0 ou 1)
     */
    public function supprimerProduit($id)
    {
        $req = "delete from produit where id=$id";
        $nbLigne = PdoBouquet::$monPdo->exec($req);
        return $nbLigne;
    }

    /**
     *Ajoute un produit dans la base de données
     * @param  $nom
     * @param  $image
     * @param  $description
     * @param  $prix
     * @param  $idCategorie
     * @return le nombre de ligne affectée par la requête
     */
    public function ajouterProduit($nom, $image, $description, $prix, $idCategorie)
    {
        $req = "insert into produit values (NULL, '$nom', '$image', '$description', '$prix', '$idCategorie')";
        $nbLigne = PdoBouquet::$monPdo->exec($req);
        return $nbLigne;
    }

    /**
     *Modifie dans la base de données le produit passé en arguement
     * @param  $id
     * @param  $nom
     * @param  $image
     * @param  $description
     * @param  $prix
     * @param  $idCategorie
     * @return le nombre de ligne affectée par la requête
     */
    public function modifierProduit($id, $nom, $image, $description, $prix, $idCategorie)
    {
        $req = "update produit set nom='$nom', image='$image', description='$description', prix='$prix', idCategorie='$idCategorie' where id='$id'";
        //echo $req;
        $nbLigne = PdoBouquet::$monPdo->exec($req);
        //echo "<<<".$nbLigne;
        return $nbLigne;
    }

    /**
     *Récupère l'identifiant du dernier produit inséré
     * @return le dernier id inséré 
     */
    public function getLastId()
    {
        return PdoBouquet::$monPdo->lastInsertId();
    }

    /**
     * Retourne les informations du produit passé en argument sous la forme d'un tableau associatif
     * @return un tableau associatif d'une ligne
     */
    public function getProduit($id)
    {
        $res = PdoBouquet::$monPdo->query("select * from produit where id=$id");   //la requête
        $laLigne = array();           // déclare un tableau vide
        $laLigne =  $res->fetch();  //rempli le tableau à l'aide de la methode fecthAll
        return $laLigne;
    }



    //================GERER PANIER ==============================================        
    /**
     * Retourne les produits concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdProduit tableau d'idProduits
     * @return un tableau associatif 
     */
    public function getLesProduitsDuTableau()
    {
        $nbProduits = nbProduitsDuPanier();
        $lesLignes = array();
        if ($nbProduits != 0) {
            foreach ($_SESSION['produits'] as $unIdProduit) {
                $req = "select * from produit where id = '$unIdProduit'";
                $res = PdoBouquet::$monPdo->query($req);
                $unProduit = $res->fetch();
                $lesLignes[] = $unProduit;
            }
        }
        return $lesLignes;
    }

    /**
     * Crée une commande et les lignes associées
     *
     * Crée une commande à partir des arguments validés passés en paramètre
     * L'identifiant est construit à partir du maximum existant
     * Crée les lignes de commandes dans la table contenir à partir du
     * tableau de Produit-quantite passé en paramètre
     * @param $lesProduits
     */
    public function creerCommande($lesProduits)
    {
        $req = "select max(id) as maxi from commande";
        $res = PdoBouquet::$monPdo->query($req);
        $laLigne = $res->fetch();
        $maxi = $laLigne['maxi'];
        $maxi++;
        $idCommande = $maxi;

        $login = $_SESSION['login']; //++
        $date = date('Y-m-d');
        $req = "insert into commande values ('$idCommande','$date', '$login')"; //++ login
        $res = PdoBouquet::$monPdo->exec($req);
        foreach ($lesProduits as $unIdProduit => $qte) {
            $req = "insert into contenir values ('$idCommande','$unIdProduit',$qte)";
            $res = PdoBouquet::$monPdo->exec($req);
        }
        return $idCommande;
    }

    //pour controle
    public function getLesCommandesClient()
    {
        $login = $_SESSION['login'];
        $req = "select idCommande, dateCommande, nom, prix, qte 
        from commande, contenir, produit "
            . "where commande.id=contenir.idCommande "
            . "and contenir.idProduit = produit.id "
            . "and loginUtilisateur='$login' "
            . "order by dateCommande desc";
        //echo $req; die();
        $res = PdoBouquet::$monPdo->query($req);   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;
    }
}//fin classe