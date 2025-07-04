<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Liste complète de mes créneaux</h2>

    <?php if (empty($creneaux)) : ?>
        <p>Aucun créneau trouvé.</p>
    <?php else : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date et heure</th>
                    <th>Projet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($creneaux as $creneau) : ?>
                    <tr>
                        <td><?= htmlspecialchars($creneau['id']) ?></td>
                        <td><?= htmlspecialchars($creneau['creneau']) ?></td>
                        <td><?= htmlspecialchars($creneau['projet']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</rewritten_file> 