<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
<div class="container">
    <?php include $root . '/app/view/fragment/fragmentMenu.php'; ?>
    <?php include $root . '/app/view/fragment/fragmentJumbotron.html'; ?>

    <h2>Choisissez un de vos projets</h2>
    <form method="get" action="router.php">
        <input type="hidden" name="action" value="planningProjet">
        <input type="hidden" name="controller" value="rdv">

        <select name="id" class="form-control" style="width:auto;">
            <?php foreach ($results as $projet): ?>
                <option value="<?= $projet['id'] ?>"><?= htmlspecialchars($projet['label']) ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <button type="submit" class="btn btn-primary">Voir le planning</button>
    </form>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
