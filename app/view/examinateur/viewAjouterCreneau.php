<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    ?>
    <h2>Ajouter un créneau à un projet</h2>
    <?php if (isset($message) && isset($alertType)) : ?>
        <div class="alert alert-<?= htmlspecialchars($alertType) ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    <form method="post" action="router.php?action=ajouterCreneau">
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
        <div class="form-group">
            <label for="creneau">Date et heure :</label>
            <input type="datetime-local" class="form-control" id="creneau" name="creneau" required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Ajouter le créneau</button>
    </form>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</rewritten_file> 