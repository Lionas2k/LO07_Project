<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patrimoine 2024</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link href="../public/css/perso_css.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
    <h1>Soutenances 2025: Login</h1>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            Identifiant ou mot de passe incorrect.
        </div>
    <?php endif; ?>
    <form action="router.php?action=treatLogin" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" class="form-control" id="login" name="login" autocomplete="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
</body>
</html>