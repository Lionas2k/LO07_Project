<?php
require_once 'Model.php';

class ModelRdv {
    private $idPersonne, $idProjet, $idCreneau;

    public function __construct($idPersonne = NULL, $idProjet = NULL, $idCreneau = NULL) {
        if (!is_null($idPersonne)) {
            $this->idPersonne = $idPersonne;
            $this->idProjet = $idProjet;
            $this->idCreneau = $idCreneau;
        }
    }

    // Getters
    public function getIdPersonne() {
        return $this->idPersonne;
    }

    public function getIdProjet() {
        return $this->idProjet;
    }

    public function getIdCreneau() {
        return $this->idCreneau;
    }

    // Récupère tous les rendez-vous
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rdv";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupère un rendez-vous par triple identifiant
    public static function getOne($idPersonne, $idProjet, $idCreneau) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rdv WHERE idPersonne = :idPersonne AND idProjet = :idProjet AND idCreneau = :idCreneau";
            $statement = $database->prepare($query);
            $statement->execute([
                'idPersonne' => $idPersonne,
                'idProjet' => $idProjet,
                'idCreneau' => $idCreneau
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
