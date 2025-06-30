<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    ?>
    <h2>Choisissez un projet</h2>
    <form method="get" action="router.php">
        <input type="hidden" name="action" value="viewCreneauxProjet">
        <div class="form-group">
            <label for="projet_id">Projet :</label>
            <select class="form-control" id="projet_id" name="projet_id" required>
                <?php foreach (
$projets as $projet): ?>
                    <option value="<?= htmlspecialchars($projet['id']) ?>">
                        <?= htmlspecialchars($projet['label']) ?> (Groupe <?= htmlspecialchars($projet['groupe']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Voir mes créneaux</button>
    </form>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body> 