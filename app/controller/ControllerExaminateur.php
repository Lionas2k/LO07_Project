<?php
require_once '../model/ModelPersonne.php';

class ControllerExaminateur {

    // Affiche tous les examinateurs
    public static function examinateurReadAll() {
        $examinateurs = ModelPersonne::getAllExaminateurs();

        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewAll.php';
        if (DEBUG)
            echo ("ControllerExaminateur : examinateurReadAll : vue = $vue");
        require($vue);
    }
    public static function examinateurInsertForm() {
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewInsert.php';
        require($vue);
    }

    // Traite le formulaire et insère l'examinateur dans la BDD
    public static function examinateurInserted() {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';

        if (!empty($nom) && !empty($prenom)) {
            $id = ModelPersonne::insertExaminateur($nom, $prenom);

            include 'config.php';
            $vue = $root . '/app/view/examinateur/viewInserted.php';
            require($vue);
        } else {
            // Redirection vers une vue d'erreur si le formulaire est incomplet
            include 'config.php';
            $vue = $root . '/app/view/viewError.php';
            require($vue);
        }
    }
    public static function selectProjetExaminateur() {
        $projets = ModelProjet::getAllResp(); // Ou getAll() si on veut tous les projets
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewSelectProjet.php';
        require($vue);
    }


    public static function listExaminateursByProjet() {
        $projet_id = $_GET['projet_id'];
        $examinateurs = ModelPersonne::getExaminateursByProjet($projet_id);
        $projet = ModelProjet::getOne($projet_id);
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewExaminateursByProjet.php';
        require($vue);
    }

}
?>
