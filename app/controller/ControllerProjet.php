
<?php
require_once '../model/ModelProjet.php';

class ControllerProjet {

    // Affiche tous les projets avec responsable
    public static function projetAllResp() {
        $tableau = ModelProjet::getAllResp();

        include 'config.php';
        $vue = $root . '/app/view/projet/viewAll.php';
        if (DEBUG)
            echo ("ControllerProjet : projetReadAll : vue = $vue");
        require($vue);
    }

    // Affiche un seul projet par ID
    public static function projetReadOne() {
        $projet_id = $_GET['id'];
        $results = ModelProjet::getOne($projet_id);

        include 'config.php';
        $vue = $root . '/app/view/projet/viewOne.php';
        require($vue);
    }
    public static function projetCreate() {
        include 'config.php';
        $vue = $root . '/app/view/projet/viewInsert.php'; // Crée ce fichier
        require($vue);
    }

    // Traite les données du formulaire et insère le projet
    public static function projetCreated() {
        $label = $_POST['label'];
        $groupe = $_POST['groupe'];

        $id = ModelProjet::insert($label, $groupe);

        include 'config.php';
        if ($id !== null) {
            $vue = $root . '/app/view/projet/viewInserted.php'; // À créer aussi
        } else {
            $vue = $root . '/app/view/error.php'; // Vue d'erreur standard
        }
        require($vue);
    }
}
?>

