<?php
require_once "Model.php";

class ModelProjet {
    private $id;
    private $libelle;

    public function __construct($id = NULL, $libelle = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->libelle = $libelle;
        }
    }

    public static function getAll() {
        $sql = "SELECT * FROM Projet";
        $req = Model::$pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelProjet');
        return $req->fetchAll();
    }

    public static function getById($id) {
        $sql = "SELECT * FROM Projet WHERE id = :id_tag";
        $req = Model::$pdo->prepare($sql);
        $values = array("id_tag" => $id);
        $req->execute($values);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelProjet');
        return $req->fetch();
    }

    public function getId() { return $this->id; }
    public function getLibelle() { return $this->libelle; }
}
?>
