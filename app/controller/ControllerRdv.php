<?php
require('../model/ModelRdv.php');
class ControllerRdv {
    public static function planningForm() {
        $results = ModelProjet::getAllResp();
        $vue = 'planningForm';
        $pagetitle = 'Voir le planning de soutenance de vos projets';
        include 'config.php';
        $vue = $root . '/app/view/responsable/viewPlanningForm.php';
        if (DEBUG)
            echo ("ControllerProjet : projetReadAll : vue = $vue");
        require($vue);
    }

    public static function planningProjet() {
        $id_projet = $_GET['id'];
        $planning = ModelRdv::getPlanningByProjet($id_projet);
        $pagetitle = 'Planning de soutenance du projet';
        include 'config.php';
        $vue = $root . '/app/view/responsable/viewPlanningProjet.php';
        if (DEBUG)
            echo ("ControllerProjet : projetReadAll : vue = $vue");
        require($vue);
    }

    public static function viewRdv() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        $id_personne = $_SESSION['user']->getId();
        $rdvs = ModelRdv::getRdvByPersonne($id_personne);
        $pagetitle = 'Mes rendez-vous';
        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewRdv.php';
        if (DEBUG)
            echo ("ControllerRdv : viewRdv : vue = $vue");
        require($vue);
    }
    public static function creerForm() {
        // Récupère la liste des examinateurs et les créneaux existants
        $examinateurs = ModelPersonne::getExaminateurs();
        $vue = 'rdvCreerForm';
        $pagetitle = 'Créer un rendez-vous';
        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewRdvCreerForm.php';
        require($vue);
    }

    public static function creerRdv() {
        $id_etudiant = $_SESSION['user']->getId();
        $id_examinateur = $_POST['examinateur'];
        $datetime = $_POST['datetime'];

        // Vérifie que la date/heure est unique
        if (ModelCreneau::dateExiste($datetime)) {
            // On peut stocker un message temporaire si besoin dans la session
            $_SESSION['message'] = "Erreur : La date et l'heure choisies sont déjà prises.";
        } else {
            $projet = ModelProjet::getProjetByEtudiant();
            if (!$projet) {
                $_SESSION['message'] = "Erreur : Aucun projet associé à cet étudiant.";
            } else {
                $id_creneau = ModelCreneau::insert($projet['id'], $id_examinateur, $datetime);
                ModelRdv::insert($id_creneau, $id_etudiant);
                $_SESSION['message'] = "Rendez-vous créé avec succès pour le $datetime.";
            }
        }

        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewRdv.php';
        if (DEBUG)
            echo ("ControllerRdv : viewRdv : vue = $vue");
        require($vue);
    }

}