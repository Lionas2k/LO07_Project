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
            $query = "SELECT * FROM rdv WHERE etudiant = :idPersonne AND creneau = :idCreneau";
            $statement = $database->prepare($query);
            $statement->execute([
                'idPersonne' => $idPersonne,
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
                   c.creneau AS date_creneau
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

    // Récupère tous les rendez-vous d'une personne
    public static function getRdvByPersonne($id_personne) {
        try {
            $database = Model::getInstance();
            $query = "
            SELECT r.id as rdv_id, p.label as projet_nom, c.creneau as date_creneau,
                   exam.nom as exam_nom, exam.prenom as exam_prenom
            FROM rdv r 
            JOIN creneau c ON r.creneau = c.id
            JOIN projet p ON c.projet = p.id
            JOIN personne exam ON c.examinateur = exam.id
            WHERE r.etudiant = :id_personne
            ORDER BY c.creneau
        ";
            $statement = $database->prepare($query);
            $statement->execute(['id_personne' => $id_personne]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Crée un nouveau rendez-vous
    public static function createRdv($id_etudiant, $id_creneau) {
        try {
            // Vérifier si le créneau est encore disponible
            if (!ModelCreneau::isCreneauDisponible($id_creneau)) {
                return false; // Le créneau est déjà pris
            }
            
            $database = Model::getInstance();
            
            // Insérer le nouveau rendez-vous
            $query1 = "SELECT MAX(id) FROM rdv";
            $statement = $database->query($query1);
            $number = $statement->fetch();
            $id = $number['0'];
            $id++;
            
            $query = "INSERT INTO rdv (id, creneau, etudiant) VALUES (:id, :creneau, :etudiant)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'creneau' => $id_creneau,
                'etudiant' => $id_etudiant
            ]);
            
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    public static function insert($id_creneau, $id_etudiant) {
        $database = Model::getInstance();
        $query1 = "SELECT MAX(id) FROM rdv";
        $statement = $database->query($query1);
        $number = $statement->fetch();
        $id = $number['0'];
        $id++;
        $pdo = Model::getInstance();
        $sql = "INSERT INTO rdv (id, creneau, etudiant) VALUES (:id, :creneau, :etudiant)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id'=>$id,
            'creneau' => $id_creneau,
            'etudiant' => $id_etudiant
        ]);
    }


}
?>
