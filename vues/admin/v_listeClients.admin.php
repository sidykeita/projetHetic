
<center>
<p><b>LISTES DES CLIENTS<b></p>
<table border='2'>
<?php
echo "Conecté : " . $_REQUEST[utilisateur];
$nbClient=0;
foreach($lesLogin as $uneLigne)
{
    echo("<tr><td>".$uneLigne["login"]."</td><td>".$uneLigne["nom"]."</td><td>".$uneLigne["mail"]."</td></tr>");
}
echo "Nombre de client : " . $nbClient++;
?>
</table>
</center>
