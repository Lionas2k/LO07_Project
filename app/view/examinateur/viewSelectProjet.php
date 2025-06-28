
<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Choisissez un projet</h2>

    <form method="get" action="router.php">
        <input type="hidden" name="action" value="listExaminateursByProjet">
        <div class="form-group">
            <label for="projet_id">Projet :</label>
            <select class="form-control" id="projet_id" name="projet_id" required>
                <?php
                foreach ($projets as $projet) {
                    printf('<option value="%d">%s (Groupe %s)</option>',
                        $projet['id'], $projet['label'], $projet['groupe']);
                }
                ?>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Voir les examinateurs</button>
    </form>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

