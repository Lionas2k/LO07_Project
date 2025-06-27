<?php
require_once '../model/ModelPersonne.php';

class ControllerLogin {

    // Traitement de la connexion
    public static function treatLogin() {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = ModelPersonne::checkLogin($login, $password);

        if ($user) {

            $_SESSION["user"] = $user;
        }

        header('Location: router.php?action=menu');
        exit();
    }

    // Affichage de la page de login
    public static function login() {
        include '../view/auth/viewLogin.php';
    }

    // Traitement de l'inscription (par défaut on inscrit comme étudiant)
    public static function treatRegister() {
        $user_id = ModelPersonne::insert(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['role_responsable'] ?? 0,
            $_POST['role_examinateur'] ?? 0,
            $_POST['role_etudiant'] ?? 0,
            $_POST['login'],
            $_POST['password']);

        $user = ModelPersonne::getById($user_id);

        if ($user) {
            $_SESSION["user"] = $user;

            header('Location: router.php?action=accueil');
            exit();
        } else {
            header('Location: router.php?action=menu');
            exit();
        }
    }



    public static function register() {
        include '../view/auth/viewRegister.php';
    }


    public static function logout() {
        unset($_SESSION["user"]);
        header('Location: router.php?action=menu');
        exit();
    }
}
?>
