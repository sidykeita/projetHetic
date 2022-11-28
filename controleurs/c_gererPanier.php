<?php
if (isset($_SESSION["statut"]) && ($_SESSION["statut"]=="client"))
{
    include("vues/client/v_sommaire.client.html");
    include("vues/v_login.php");
    
    if (!isset ($_REQUEST["action"]))
            $action ="voirTousProduits";
    else
            $action = $_REQUEST["action"];

    initPanier();

	switch($action)
	{
		case "voirTousProduits" :  //affiche tous les produits
		{
                    $lesCategories = $pdo->getLesCategories();
                    include("vues/client/v_listeCategories.client.php");
                    if (isset($_POST["idCategorie"]))
                    {
                        $idCategorie=$_POST["idCategorie"];
                       if ($idCategorie=='Tous')
                            $lesProduits = $pdo->getTousLesProduits();
                        else
                            $lesProduits = $pdo->getLesProduitsCategorie($idCategorie);    
                    }else
                    $lesProduits = $pdo->getTousLesProduits(); 
                    include("vues/client/v_listeProduits.client.php");

                    break;
		}		
				
		case "ajouterAuPanier" :   //rajoute le produit au panier du tableau produits en session  
		{
                    $id=$_REQUEST["id"];
                    ajouterAuPanier($id);                       
                    $lesCategories = $pdo->getLesCategories();
                    include("vues/client/v_listeCategories.client.php");
                    $lesProduits = $pdo->getTousLesProduits(); 
                    include("vues/client/v_listeProduits.client.php");
			
                    break;
		}
	
		case "voirPanier" :   //affiche la vue du panier du tableau produits en session   
		{
                    $n = nbProduitsDuPanier();
                    if($n>0)
                    {
                       $lesProduitsDuPanier = $pdo->getLesProduitsDuTableau();
                       include("vues/client/v_panier.client.php");
                    }
                    else
                    {
                        $message = "panier vide !!";
                        include ("vues/v_message.php");
                    }
                    
                    break;
		}

		case "supprimerUnProduit" :   //supprime le produit du panier du tableau produits en session  
		{
			$id=$_REQUEST["id"];
			retirerDuPanier($id);
                        $n= nbProduitsDuPanier();
                        if($n>0)
                        {
                            $lesProduitsDuPanier = $pdo->getLesProduitsDuTableau();
                            include("vues/client/v_panier.client.php");
                        }
                        else
                        {
                            $message = "Panier vide !!";
                            include ("vues/v_message.php");
                        }  
			
                        break;
		}		
	
		case "validerCommande" :   //enregistre le panier dans la bdd et affiche le n° cde
		{
                    $lesProduitsCommandes = $_REQUEST['quantite']; //on récupère le tableau ['quantite'][idProduit][qte] du select 
                   // var_dump($lesProduitsCommandes);                    
                   // die();
                    $numCommande=$pdo->creerCommande($lesProduitsCommandes);
                    if ($numCommande > 0)
                    {                           
                        $message = "Votre commande a été bien enregistrée numéro : " . $numCommande;	//++ $numCommande
                        include ("vues/v_message.php");
                        supprimerPanier(); //detruit la variable de session
                    }
                    else
                    {
                        $message = "Echec. Veuillez réessayer."; //++ $message
                        include ("vues/v_message.php");  //++
                    }

                    break;
                }    
                    
                case "suivreCommandes" :
                {
                    $lesCommandes = $pdo->getLesCommandesClient();
                    include("vues/client/v_listeCommandes.client.php");
                    
                    
		}		
	}
}
else
{
     include("vues/v_formConnexion.html");
     include("vues/v_sommaireIndex.html") ;
}
?>

