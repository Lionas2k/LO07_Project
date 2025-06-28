
<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Projet créé</h2>
    <p>Le projet <strong><?php echo htmlspecialchars($label); ?></strong> du groupe <strong><?php echo htmlspecialchars($groupe); ?></strong> a bien été ajouté avec succès.</p>

    <a class="btn btn-success mt-3" href="router.php?action=projetAllResp">Voir mes projets</a>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

