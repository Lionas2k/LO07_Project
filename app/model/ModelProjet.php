<!-- Début de ModelProjet -->
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
        $database = Model::getInstance();
        $query = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
                  FROM projet
                  JOIN personne ON projet.responsable = personne.id";
        $statement = $database->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
<!-- Fin de ModelProjet -->