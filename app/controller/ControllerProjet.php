<<<<<<< HEAD
=======
<!-- Début de ControllerProjet -->

>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
<?php
require_once '../model/ModelProjet.php';

class ControllerProjet {

    // Affiche tous les projets avec responsable
    public static function projetReadAll() {
        $tableau = ModelProjet::getAll();

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
}
?>
<<<<<<< HEAD
=======

<!-- Fin de ControllerProjet -->
>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
