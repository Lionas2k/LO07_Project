
<!-- ----- début fragmentMenu -->

<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <?php
    if (isset($_SESSION["user"])) {

        $nom = $_SESSION["user"]->getNom();
        $prenom = $_SESSION["user"]->getPrenom();


        echo "<a class='navbar-brand' href='router.php?action=accueil'>LAURENS-CLAVERIE | $nom $prenom |</a>";

    } else {
    echo "<a class='navbar-brand' href='router.php?action=accueil'>LAURENS-CLAVERIE | Invité</a>";
    }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]->getRoleResponsable()) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Responsable</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router.php?action=projetAllResp">Liste de mes projets</a></li>
            <li><a class="dropdown-item" href="router.php?action=projetCreate">Ajout d'un projet</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="router.php?action=examinateurReadAll">Liste des examinateurs</a></li>
            <li><a class="dropdown-item" href="router.php?action=examinateurInsertForm">Ajout d'un examinateur</a></li>
            <li><a class="dropdown-item" href="router.php?action=selectProjetExaminateur">Liste des examinateurs d'un projet</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="router.php?action=planningForm">Planning d'un projet</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]->getRoleExaminateur()) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Examinateur</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router.php?action=mesProjetsExaminateur">Liste de mes projets</a></li>
            <li><a class="dropdown-item" href="router.php?action=viewAllCreneaux">Liste complète de mes créneaux</a></li>
            <li><a class="dropdown-item" href="router.php?action=viewCreneauxProjet">Liste de mes créneaux pour un projet</a></li>
            <li><a class="dropdown-item" href="router.php?action=viewAjouterCreneau">Ajouter un créneau à un projet</a></li>
            <li><a class="dropdown-item" href="router.php?action=viewAjouterCreneauxConsecutifs">Ajouter des créneaux consécutifs</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]->getRoleEtudiant()) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Etudiant</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router.php?action=viewRdv">Liste de mes RDV</a></li>
            <li><a class="dropdown-item" href="router.php?action=creerForm">Prendre un RDV pour un projet</a></li>
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovation</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router.php?action=innovationData">Automatisation Comptable</a></li>
            <li><a class="dropdown-item" href="router.php?action=innovationMvc">MVC & Symfony</a></li>
          </ul>
        </li>
        <?php if (isset($_SESSION["user"])) { ?>
        <li class="nav-item">
          <a class="nav-link" href="router.php?action=logout">Se déconnecter</a>
        </li>
        <?php } else { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router.php?action=login">Login</a></li>
            <li><a class="dropdown-item" href="router.php?action=register">S'inscrire</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav> 

<!-- ----- fin fragmentMenu -->

