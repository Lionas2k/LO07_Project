<?php
require_once '../model/ModelPersonne.php';
session_start();

require ('../controller/ControllerProjet.php');
require ('../controller/ControllerLogin.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $param);
if(isset ($param["action"])){
    $action = htmlspecialchars($param["action"]);
    unset($param['action']);
}
else{
    $action = '';
}
$args = $param;



// --- routage
switch ($action) {

    // Routes pour ControllerProjet
    case "projetReadAll":
    case "projetReadOne":
        ControllerProjet::$action($args);
        break;

    // Routes pour ControllerLogin
    case "login":
    case "treatLogin":
    case "logout":
    case "register":
    case "treatRegister":
        ControllerLogin::$action($args);
        break;


    default:
        include '../view/Accueil.php';
        break;
}
?>
