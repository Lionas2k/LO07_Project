<?php
require_once '../model/ModelPersonne.php';
session_start();

require ('../controller/ControllerProjet.php');
require ('../controller/ControllerLogin.php');
require('../controller/ControllerExaminateur.php');
require('../controller/ControllerRdv.php');
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
    case "projetAllResp":
    case "projetReadOne":
    case "projetCreate":
    case "projetCreated":
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
        // Routes pour examinateur
    case "examinateurReadAll":
    case "examinateurInserted":
    case "examinateurInsertForm":
    case "selectProjetExaminateur":
    case "listExaminateursByProjet":
        ControllerExaminateur::$action($args);
        break;
        // route pour RDV
    case "planningForm":
    case "planningProjet":
    case "viewRdv":
    case "viewPrendreRdv":
    case "creerForm":
    case "creerRdv":
        ControllerRdv::$action($args);
        break;
    case "mesProjetsExaminateur":
        ControllerProjet::mesProjetsExaminateur($args);
        break;
    case "innovationData":
        include '../view/innovationData.php';
        break;
    case "innovationMvc":
        include '../view/innovationMvc.php';
        break;
    case "viewAllCreneaux":
        ControllerExaminateur::viewAllCreneaux($args);
        break;
    case "viewCreneauxProjet":
        ControllerExaminateur::viewCreneauxProjet($args);
        break;
    case "viewAjouterCreneau":
        ControllerExaminateur::viewAjouterCreneau($args);
        break;
    case "ajouterCreneau":
        ControllerExaminateur::ajouterCreneau($args);
        break;
    case "viewAjouterCreneauxConsecutifs":
        ControllerExaminateur::viewAjouterCreneauxConsecutifs($args);
        break;
    case "ajouterCreneauxConsecutifs":
        ControllerExaminateur::ajouterCreneauxConsecutifs($args);
        break;
    default:
        include '../view/Accueil.php';
        break;
}
?>
