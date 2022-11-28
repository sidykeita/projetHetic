
<?php
include("vues/admin/v_sommaire.admin.html");

$action = $_REQUEST["action"];

switch ($action) {
    case "listeClients":
        {
            echo"ici";
        $statut = $_SESSION['statut'];
        $lesLogin = $pdo->getLeslogin();
        include ('vues/admin/v_listeClients.admin.php');
        break;
    }
}
?>