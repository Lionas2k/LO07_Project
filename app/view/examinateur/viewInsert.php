<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Ajout d’un nouvel examinateur</h2>

    <form role="form" method="post" action="router.php?action=examinateurInserted">
        <div class="form-group">
            <label for="nom">Nom : </label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom : </label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

