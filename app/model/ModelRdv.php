
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
    public static function getPlanningByProjet($id_projet) {
        try {
            $database = Model::getInstance();
            $query = "
            SELECT p.nom AS etu_nom, p.prenom AS etu_prenom,
                   exam.nom AS exam_nom, exam.prenom AS exam_prenom,
                   c.date AS date_creneau
            FROM rdv r 
            JOIN personne p ON p.id = r.etudiant
            JOIN creneau c ON r.creneau = c.id
            JOIN personne exam ON c.examinateur = exam.id
            WHERE c.projet = :id
        ";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id_projet]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

}
?>
