<?php
require_once 'Model.php';

class ModelPersonne {
    private $id, $nom, $prenom, $statut;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $statut = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->statut = $statut;
        }
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getStatut() {
        return $this->statut;
    }

    // Récupère toutes les personnes
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupère une personne par son id
    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
