
<!-- ----- debut de la page cave_acceuil -->
<?php include 'fragment/fragmentHeader.html'; ?>
<body>
<div class="container">
    <?php
    include 'fragment/fragmentMenu.php';
    include 'fragment/fragmentJumbotron.html';
    ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <p class="alert"><?= $_SESSION['message'] ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

</div>


<?php
include 'fragment/fragmentFooter.html';
?>

<!-- ----- fin de la page cave_acceuil -->

</body>
</html>