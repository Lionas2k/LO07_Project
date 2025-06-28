
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
    public static function getAllResp() {

        if (!isset($_SESSION['user'])) {
            return []; // Pas d'utilisateur connecté : on ne retourne rien
        }
        $user = $_SESSION['user'];
        $responsable_id = $user->getId();

        $database = Model::getInstance();
        $query = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
              FROM projet
              JOIN personne ON projet.responsable = personne.id
              WHERE projet.responsable = :responsable_id";

        $statement = $database->prepare($query);
        $statement->execute(['responsable_id' => $responsable_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    public static function insert($label, $groupe) {
        if (!isset($_SESSION['user'])) {
            return null; // Aucun utilisateur connecté
        }

        $user = $_SESSION['user'];
        $responsable_id = $user->getId(); // L'utilisateur connecté devient responsable du projet

        try {
            $database = Model::getInstance();
            $query1 = "SELECT MAX(id) FROM projet";
            $statement = $database->query($query1);
            $number= $statement->fetch();
            $id = $number['0'];
            $id++;
            $query = "INSERT INTO projet (id,label, groupe, responsable) 
                  VALUES (:id,:label, :groupe, :responsable)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'label' => $label,
                'groupe' => $groupe,
                'responsable' => $responsable_id
            ]);

            return $database->lastInsertId(); // Retourne l'ID du nouveau projet
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
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

