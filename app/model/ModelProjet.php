<<<<<<< HEAD
=======
<!-- Début de ModelProjet -->
>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
<?php
require_once 'Model.php';

class ModelProjet {
    private $id, $libelle;

    public function __construct($id = NULL, $libelle = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->libelle = $libelle;
        }
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    // Liste tous les projets
    // Récupère tous les projets avec les infos du responsable
    public static function getAll() {
<<<<<<< HEAD
            $database = Model::getInstance();
            $query = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
                  FROM projet
                  JOIN personne ON projet.responsable = personne.id";
            $statement = $database->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
=======
        $database = Model::getInstance();
        $query = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
                  FROM projet
                  JOIN personne ON projet.responsable = personne.id";
        $statement = $database->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
    }


    // Récupère un projet par son id
    public static function getOne(int $id) {
        $database = Model::getInstance();
        $query = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
                  FROM projet
                  JOIN personne ON projet.responsable = personne.id
                  WHERE projet.id = :id";
        $statement = $database->prepare($query);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<<<<<<< HEAD
=======
<!-- Fin de ModelProjet -->
>>>>>>> 78e86e2b08fc5ff83495e17a0e7371a3d04a1639
