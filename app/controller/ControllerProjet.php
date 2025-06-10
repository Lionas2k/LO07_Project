<?php
require_once '../model/ModelProjet.php';

class ControllerProjet {

    //Affiche tous les projets
    public static function projetReadAll() {
        $results = ModelProjet::getAll();

        include 'config.php';
        $vue = $root . '/app/view/projet/viewAll.php';
        if (DEBUG)
            echo ("ControllerProjet : projetReadAll : vue = $vue");
        require ($vue);
    }

    // Affiche un seul projet par ID
    public static function projetReadOne() {
        $projet_id = $_GET['id'];
        $results = ModelProjet::getById($projet_id);


        include 'config.php';
        $vue = $root . '/app/view/projet/viewAll.php';
        require ($vue);
    }

}
?>
