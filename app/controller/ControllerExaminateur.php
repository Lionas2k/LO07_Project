<?php
require_once '../model/ModelPersonne.php';
require_once '../model/ModelCreneau.php';

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

    // Ajout : liste complète des créneaux de l'examinateur
    public static function viewAllCreneaux() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_examinateur = $_SESSION['user']->getId();
        $creneaux = ModelCreneau::getAllByExaminateur($id_examinateur);
        $pagetitle = 'Liste complète de mes créneaux';
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewAllCreneaux.php';
        require($vue);
    }

    // Affiche les créneaux de l'examinateur pour un projet donné
    public static function viewCreneauxProjet() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_examinateur = $_SESSION['user']->getId();

        // Si le projet n'est pas encore choisi, on affiche le formulaire de sélection
        if (!isset($_GET['projet_id'])) {
            $projets = ModelProjet::getProjetsByExaminateur($id_examinateur);
            include 'config.php';
            $vue = $root . '/app/view/examinateur/viewSelectProjetCreneaux.php';
            require($vue);
            return;
        }

        // Sinon, on affiche les créneaux pour ce projet
        $projet_id = $_GET['projet_id'];
        $creneaux = ModelCreneau::getByExaminateurAndProjet($id_examinateur, $projet_id);
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewCreneauxProjet.php';
        require($vue);
    }

    // Affiche le formulaire d'ajout de créneau
    public static function viewAjouterCreneau() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_examinateur = $_SESSION['user']->getId();
        $projets = ModelProjet::getProjetsByExaminateur($id_examinateur);
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewAjouterCreneau.php';
        require($vue);
    }

    // Traite l'ajout d'un créneau
    public static function ajouterCreneau() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_examinateur = $_SESSION['user']->getId();
        $projet_id = $_POST['projet_id'];
        $datetime = $_POST['creneau'];
        ModelCreneau::insert($projet_id, $id_examinateur, $datetime);
        $projets = ModelProjet::getProjetsByExaminateur($id_examinateur);
        $message = "Créneau ajouté avec succès !";
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewAjouterCreneau.php';
        require($vue);
    }

    // Affiche le formulaire d'ajout de créneaux consécutifs
    public static function viewAjouterCreneauxConsecutifs() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_examinateur = $_SESSION['user']->getId();
        $projets = ModelProjet::getProjetsByExaminateur($id_examinateur);
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewAjouterCreneauxConsecutifs.php';
        require($vue);
    }

    // Traite l'ajout de créneaux consécutifs
    public static function ajouterCreneauxConsecutifs() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_examinateur = $_SESSION['user']->getId();
        $projet_id = $_POST['projet_id'];
        $datetime = $_POST['creneau_debut'];
        $nb = max(1, min(10, intval($_POST['nb_creneaux'])));
        $errors = 0;
        $added = 0;
        $dt = new DateTime($datetime);
        for ($i = 0; $i < $nb; $i++) {
            $dt_str = $dt->format('Y-m-d H:i:s');
            if (ModelCreneau::exists($projet_id, $id_examinateur, $dt_str)) {
                $errors++;
            } else {
                ModelCreneau::insert($projet_id, $id_examinateur, $dt_str);
                $added++;
            }
            $dt->modify('+1 hour');
        }
        if ($added === 0) {
            $message = "Erreur : tous les créneaux demandés existent déjà. Aucun créneau ajouté.";
            $alertType = "danger";
        } elseif ($errors > 0) {
            $message = "Attention : $errors créneau(x) déjà existant(s) n'ont pas été ajoutés. $added créneau(x) ajouté(s) avec succès.";
            $alertType = "warning";
        } else {
            $message = "$added créneau(x) ajouté(s) avec succès !";
            $alertType = "success";
        }
        $projets = ModelProjet::getProjetsByExaminateur($id_examinateur);
        include 'config.php';
        $vue = $root . '/app/view/examinateur/viewAjouterCreneauxConsecutifs.php';
        require($vue);
    }

}
?>
