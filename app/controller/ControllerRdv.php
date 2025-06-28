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


}