<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
<div class="container">
    <?php include $root . '/app/view/fragment/fragmentMenu.php'; ?>
    <?php include $root . '/app/view/fragment/fragmentJumbotron.html'; ?>

    <h2>Planning de soutenance</h2>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Étudiant</th>
            <th>Date & Heure</th>
            <th>Examinateur</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($planning as $ligne): ?>
            <tr>
                <td><?= $ligne['etu_prenom'] . ' ' . $ligne['etu_nom'] ?></td>
                <td><?= date('d/m/Y H:i', strtotime($ligne['date_creneau'])) ?></td>
                <td><?= $ligne['exam_prenom'] . ' ' . $ligne['exam_nom'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
