<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    ?>
    <h2>Mes créneaux pour ce projet</h2>
    <?php if (empty(
$creneaux)) : ?>
        <p>Aucun créneau trouvé pour ce projet.</p>
    <?php else : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date et heure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (
$creneaux as $creneau) : ?>
                    <tr>
                        <td><?= htmlspecialchars($creneau['id']) ?></td>
                        <td><?= htmlspecialchars($creneau['creneau']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</rewritten_file> 