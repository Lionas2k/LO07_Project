<!-- ----- début viewAll -->
<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>


    <h2>Liste des projets</h2>
    <table border="1" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">ID Projet</th>
            <th scope="col">Libellé</th>
            <th scope="col">Groupe</th>
            <th scope="col">Responsable</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des vins est dans une variable $results
        foreach ($tableau as $projet) {
            printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%.2f</td></tr>", $projet['id'],
                $projet['label'], $projet['groupe'],$projet['prenom'] . ' ' . $projet['nom']);;
        }
        ?>
        </tbody>
    </table>

</div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
<!-- ----- fin viewAll -->
