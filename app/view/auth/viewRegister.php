

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Soutenances</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link href="../public/css/perso_css.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Inscription</h1>
    <form action="router.php?action=treatRegister" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" autocomplete="family-name" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" autocomplete="given-name" required>
        </div>

        <div class="mb-3">
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" class="form-control" id="login" name="login" autocomplete="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
        </div>

        <fieldset class="mb-3">
            <legend>Rôle(s)</legend>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="role_responsable" id="role_responsable" value="1">
                <label class="form-check-label" for="role_responsable">Responsable</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="role_examinateur" id="role_examinateur" value="1">
                <label class="form-check-label" for="role_examinateur">Examinateur</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="role_etudiant" id="role_etudiant" value="1" checked>
                <label class="form-check-label" for="role_etudiant">Étudiant</label>
            </div>
        </fieldset>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Créer le compte</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="../../router/router.php?action=login">Déjà inscrit ? Se connecter</a>
    </div>
</div>
</body>
</html>
