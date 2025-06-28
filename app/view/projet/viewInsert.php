<!-- ----- début viewInsert -->
<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Création d’un nouveau projet</h2>
    <form role="form" method="post" action="router.php?action=projetCreated">
        <div class="form-group">
            <label for="label">Nom du projet : </label>
            <input type="text" class="form-control" id="label" name="label" required>
        </div>
        <div class="form-group">
            <label for="groupe">Nom du groupe : </label>
            <input type="text" class="form-control" id="groupe" name="groupe" required>
        </div>
        <p />
        <button class="btn btn-primary" type="submit">Créer le projet</button>
    </form>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
<!-- ----- fin viewInsert -->
