<br>
<center>
<img src="././images/panier.jpg"	alt="Panier" title="panier"/>
<br>
<br>
<?php
	echo "<form method=POST action=index.php?uc=gererPanier&action=validerCommande>";
            foreach($lesProduitsDuPanier as $unProduit)
            {
               	$id = $unProduit['id'];
                $nom = $unProduit['nom'];
                $description = $unProduit['description'];
                $prix = $unProduit['prix'];
		$url ="<a href=index.php?uc=gererPanier&action=supprimerUnProduit&id=$id>Retirer du panier</a>";
		echo "Produit n°" . $id . "    " . $nom ." à ". $prix . " €        ";
                echo "Quantité :&nbsp;
                <select name=quantite[$id] size=1>
                <option selected value=1>1";
                    for($i = 2; $i <=10; $i++)
                        echo "<option value=$i ?>$i";
                echo "</select>&nbsp;&nbsp";
                echo $url . "<br>";
		//<input type=text maxlength=2 name=quantite[$id] size=3 value=1>&nbsp;&nbsp;&nbsp;&nbsp
                echo "<br>";
            }
		echo "<br><br>";
		echo "<input type='submit' value='Valider la commande'>";
	echo "</form>";
?>
</center>
