<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    ?>

    <h2><?php echo $pagetitle; ?></h2>
    
    <?php if (empty($rdvs)): ?>
        <div class="alert alert-info">
            Vous n'avez aucun rendez-vous de soutenance programmé.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">ID RDV</th>
                <th scope="col">Projet</th>
                <th scope="col">Date et heure</th>
                <th scope="col">Examinateur</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($rdvs as $rdv) {
                $date = new DateTime($rdv['date_creneau']);
                printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s %s</td></tr>",
                    $rdv['rdv_id'],
                    htmlspecialchars($rdv['projet_nom']),
                    $date->format('d/m/Y à H:i'),
                    htmlspecialchars($rdv['exam_nom']),
                    htmlspecialchars($rdv['exam_prenom'])
                );
            }
            ?>
            </tbody>
        </table>
        
        <div class="alert alert-success">
            Vous avez <?php echo count($rdvs); ?> rendez-vous de soutenance programmé<?php echo count($rdvs) > 1 ? 's' : ''; ?>.
        </div>
    <?php endif; ?>
    
    <div class="mt-3">
        <a href="router.php?action=viewPrendreRdv" class="btn btn-success">Prendre un nouveau rendez-vous</a>
        <a href="router.php?action=accueil" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</div>


<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body> 