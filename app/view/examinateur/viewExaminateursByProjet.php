
<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Examinateurs pour le projet : <?php echo htmlspecialchars($projet['label']); ?> (Groupe <?php echo $projet['groupe']; ?>)</h2>

    <?php if (empty($examinateurs)) : ?>
        <p>Aucun examinateur associé à ce projet.</p>
    <?php else : ?>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($examinateurs as $examinateur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($examinateur['nom']); ?></td>
                    <td><?php echo htmlspecialchars($examinateur['prenom']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

