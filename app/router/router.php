<<<<<<< HEAD
=======
<!-- Début de Router -->

>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
<?php
require ('../controller/ControllerProjet.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

parse_str($query_string, $param);

$action = htmlspecialchars($param["action"]);

unset($param['action']);


$args = $param;


switch ($action) {
    case "projetReadAll":
    case "projetReadOne":
        ControllerProjet::$action($args);
        break;

    default:
        echo "<h3>Erreur : action inconnue '$action'</h3>";
        break;
}
?>
<<<<<<< HEAD
=======

<!-- Fin de router -->
>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
