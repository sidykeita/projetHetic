<?php
$action = $_REQUEST['action'];
    switch($action){
        case 'valideConnexion':{
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $utilisateur = $pdo->getInfosUtilisateur($login,$mdp);
		if(!is_array($utilisateur)){
                 	ajouterErreur("Login ou mot de passe incorrect");
                    	include("vues/v_formConnexion.html");
                    	include("vues/v_sommaireIndex.html") ;
                    	include("vues/v_erreurs.php");
                	}
		else{
                    $nom =  $utilisateur['nom'];
	            $statut = $utilisateur['statut'];
                    connecter($login,$nom,$statut); 
                     $lesCategories = $pdo->getLesCategories();
                     $lesProduits = $pdo->getTousLesProduits(); 
                       	if ($statut=='admin')
                        {
                            include("controleurs/c_gererProduit.php");
                            include("vues/admin/v_listeCategories.admin.php");    
                            include("vues/admin/v_listeProduits.admin.php");   
                            include("vue/admin/v_listeClients.admin.php");
                        }
                        if ($statut=='client')
                        {
                            include("controleurs/c_gererPanier.php"); 
                            include("vues/client/v_listeCategories.client.php");    
                            include("vues/client/v_listeProduits.client.php"); 
                            
                        }
                        
                }
		break;
        }
        
        case 'deconnexion':{
                deconnecter();
                include("vues/v_formConnexion.html");
                include("vues/v_sommaireIndex.html") ;
                break;
        }

        
	default :{
                	include("vues/v_formConnexion.html");
                	include("vues/v_sommaireIndex.html") ;
		break;
        }
    }
?>

