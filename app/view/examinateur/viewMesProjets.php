<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Mes projets en tant qu'examinateur</h2>

    <?php if (empty($projets)) : ?>
        <p>Aucun projet trouvé.</p>
    <?php else : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Groupe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet) : ?>
                    <tr>
                        <td><?= htmlspecialchars($projet['id']) ?></td>
                        <td><?= htmlspecialchars($projet['label']) ?></td>
                        <td><?= htmlspecialchars($projet['groupe']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body> 