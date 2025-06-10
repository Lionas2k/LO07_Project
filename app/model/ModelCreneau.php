<?php
require_once "Model.php";

class ModelCreneau {
    private $id;
    private $jour;
    private $horaire;

    public function __construct($id = NULL, $jour = NULL, $horaire = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->jour = $jour;
            $this->horaire = $horaire;
        }
    }

    public static function getAll() {
        $sql = "SELECT * FROM Creneau";
        $req = Model::$pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
        return $req->fetchAll();
    }

    public static function getById($id) {
        $sql = "SELECT * FROM Creneau WHERE id = :id_tag";
        $req = Model::$pdo->prepare($sql);
        $values = array("id_tag" => $id);
        $req->execute($values);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
        return $req->fetch();
    }

    public function getId() { return $this->id; }
    public function getJour() { return $this->jour; }
    public function getHoraire() { return $this->horaire; }
}
?>
