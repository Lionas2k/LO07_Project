<!-- Début de Router -->

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

<!-- Fin de router -->
