<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    ?>
    <h2>Ajouter des créneaux consécutifs à un projet</h2>
    <?php if (isset($message) && isset($alertType)) : ?>
        <div class="alert alert-<?= htmlspecialchars($alertType) ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    <form method="post" action="router.php?action=ajouterCreneauxConsecutifs">
        <div class="form-group">
            <label for="projet_id">Projet :</label>
            <select class="form-control" id="projet_id" name="projet_id" required>
                <?php foreach ($projets as $projet): ?>
                    <option value="<?= htmlspecialchars($projet['id']) ?>">
                        <?= htmlspecialchars($projet['label']) ?> (Groupe <?= htmlspecialchars($projet['groupe']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="creneau_debut">Date et heure de début :</label>
            <input type="datetime-local" class="form-control" id="creneau_debut" name="creneau_debut" required>
        </div>
        <div class="form-group">
            <label for="nb_creneaux">Nombre de créneaux consécutifs (1 à 10) :</label>
            <input type="number" class="form-control" id="nb_creneaux" name="nb_creneaux" min="1" max="10" value="1" required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Ajouter les créneaux</button>
    </form>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</rewritten_file> 