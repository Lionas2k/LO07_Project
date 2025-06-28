<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h2>Liste des examinateurs</h2>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Login</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($examinateurs as $examinateur) {
            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                $examinateur['id'], $examinateur['nom'], $examinateur['prenom'], $examinateur['login']);
        }
        ?>
        </tbody>
    </table>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
