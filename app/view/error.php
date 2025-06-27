<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur - Application</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link href="../public/css/perso_css.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Une erreur est survenue</h4>
        <p>
            <?= htmlspecialchars($errorMessage ?? "Une erreur inconnue s'est produite. Veuillez réessayer plus tard.") ?>
        </p>
        <hr>
        <a href="router.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</div>
</body>
</html>
