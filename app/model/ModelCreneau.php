<!-- Début de ModelCreneau -->

<?php
require_once 'Model.php';

class ModelCreneau {
    private $id, $jour, $horaire;

    public function __construct($id = NULL, $jour = NULL, $horaire = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->jour = $jour;
            $this->horaire = $horaire;
        }
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getJour() {
        return $this->jour;
    }

    public function getHoraire() {
        return $this->horaire;
    }

    // Récupère tous les créneaux
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM creneau";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupère un créneau par son id
    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM creneau WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>

<!-- Fin de ModelCreneau -->
