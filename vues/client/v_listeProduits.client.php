<table width=90%  border='2'>
    <?php
    foreach ($lesProduits as $uneLigne) {
        $nom=$uneLigne["nom"];
        $id=$uneLigne["id"];
        $description = $uneLigne["description"];
	$prix=$uneLigne["prix"];
	$image = $uneLigne["image"];
        echo ("<tr>
                <td>" . $uneLigne["id"] . "</td>
                <td>" . $uneLigne["nom"] . "</td>
                <td>" . $uneLigne["description"] . "</td>
                <td>" . $uneLigne["prix"] . " €</td>
                <td><img src=images/" . $uneLigne["image"] . "  width='106' height='105'></td>");
        
        
        if (!estDansLePanier($id))
        {
            echo ("<td><center>
                <form method=post action=index.php?uc=gererPanier&action=ajouterAuPanier>
                <input type=hidden name=id value=$id>
                <input type=submit value='Ajouter au panier'>
                </form>
                </center></td>
                </tr>");
        }
        else
        {
            echo ("<td><center><font color=blue>Commandé</font></center></td>
                </tr>");
        }
    }
    ?>
</table>
