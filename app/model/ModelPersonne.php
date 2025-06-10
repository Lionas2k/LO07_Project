<?php
require_once "Model.php";

class ModelPersonne {
    private $id;
    private $nom;
    private $prenom;
    private $statut;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $statut = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->statut = $statut;
        }
    }

    public static function getAll() {
        $sql = "SELECT * FROM Personne";
        $req = Model::$pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelPersonne');
        return $req->fetchAll();
    }

    public static function getById($id) {
        $sql = "SELECT * FROM Personne WHERE id = :id_tag";
        $req = Model::$pdo->prepare($sql);
        $values = array("id_tag" => $id);
        $req->execute($values);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelPersonne');
        return $req->fetch();
    }

    // Getters (optionnel)
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getStatut() { return $this->statut; }
}
?>
