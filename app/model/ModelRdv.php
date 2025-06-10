<?php
require_once "Model.php";

class ModelRdv {
    private $idPersonne;
    private $idProjet;
    private $idCreneau;

    public function __construct($idPersonne = NULL, $idProjet = NULL, $idCreneau = NULL) {
        if (!is_null($idPersonne)) {
            $this->idPersonne = $idPersonne;
            $this->idProjet = $idProjet;
            $this->idCreneau = $idCreneau;
        }
    }

    public static function getAll() {
        $sql = "SELECT * FROM Rdv";
        $req = Model::$pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelRdv');
        return $req->fetchAll();
    }

    public static function getByIds($idPersonne, $idProjet, $idCreneau) {
        $sql = "SELECT * FROM Rdv 
                WHERE idPersonne = :idPersonne_tag 
                AND idProjet = :idProjet_tag 
                AND idCreneau = :idCreneau_tag";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "idPersonne_tag" => $idPersonne,
            "idProjet_tag" => $idProjet,
            "idCreneau_tag" => $idCreneau
        );
        $req->execute($values);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelRdv');
        return $req->fetch();
    }

    public function getIdPersonne() { return $this->idPersonne; }
    public function getIdProjet() { return $this->idProjet; }
    public function getIdCreneau() { return $this->idCreneau; }
}
?>
