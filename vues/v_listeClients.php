<h2>
    <center><b>LISTES DES CLIENTS<b></center>
</h2>
<table border='2'>
    <?php
    foreach ($lesLogin as $uneLigne) {
        echo ("<tr><td>" . $uneLigne["login"] . "</td><td>" . $uneLigne["nom"] . "</td><td>" . $uneLigne["mail"] . "</td></tr>");
    }
    ?>
</table>