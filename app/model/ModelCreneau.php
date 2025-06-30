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

    // Récupère tous les créneaux d'un examinateur
    public static function getAllByExaminateur($examinateur_id) {
        $database = Model::getInstance();
        $query = "SELECT creneau.id, creneau.projet, creneau.creneau
                  FROM creneau
                  WHERE creneau.examinateur = :examinateur_id";
        $statement = $database->prepare($query);
        $statement->execute(['examinateur_id' => $examinateur_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère les créneaux d'un examinateur pour un projet donné
    public static function getByExaminateurAndProjet($examinateur_id, $projet_id) {
        $database = Model::getInstance();
        $query = "SELECT id, creneau FROM creneau WHERE examinateur = :examinateur_id AND projet = :projet_id";
        $statement = $database->prepare($query);
        $statement->execute([
            'examinateur_id' => $examinateur_id,
            'projet_id' => $projet_id
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insère un nouveau créneau
    public static function insert($projet_id, $examinateur_id, $datetime) {
        $database = Model::getInstance();
        $query1 = "SELECT MAX(id) FROM creneau";
        $statement = $database->query($query1);
        $number = $statement->fetch();
        $id = $number[0] + 1;

        $query = "INSERT INTO creneau (id, projet, examinateur, creneau) VALUES (:id, :projet, :examinateur, :creneau)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $id,
            'projet' => $projet_id,
            'examinateur' => $examinateur_id,
            'creneau' => $datetime
        ]);
        return $id;
    }

    // Vérifie si un créneau existe déjà pour ce projet, examinateur et datetime
    public static function exists($projet_id, $examinateur_id, $datetime) {
        $database = Model::getInstance();
        $query = "SELECT COUNT(*) FROM creneau WHERE projet = :projet AND examinateur = :examinateur AND creneau = :creneau";
        $statement = $database->prepare($query);
        $statement->execute([
            'projet' => $projet_id,
            'examinateur' => $examinateur_id,
            'creneau' => $datetime
        ]);
        return $statement->fetchColumn() > 0;
    }
}
?>

