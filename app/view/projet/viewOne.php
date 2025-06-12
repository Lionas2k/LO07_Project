<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.html';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <!-- ----- début viewOne -->
    <?php
    require ($root . '/app/view/fragment/fragmentHeader.html');
    ?>

    <body>
    <div class="container">
        <h3>Détail du projet</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Libellé</th>
                <th>Groupe</th>
                <th>Responsable (nom prénom)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($results)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($results['id']) . "</td>";
                echo "<td>" . htmlspecialchars($results['label']) . "</td>";
                echo "<td>" . htmlspecialchars($results['groupe']) . "</td>";
                echo "<td>" . htmlspecialchars($results['nom']) . " " . htmlspecialchars($results['prenom']) . "</td>";
                echo "</tr>";
            } else {
                echo "<tr><td colspan='4'>Projet introuvable.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
    <!-- ----- fin viewOne -->

</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
