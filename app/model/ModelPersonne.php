<?php
require_once 'Model.php';

class ModelPersonne {
    private $id, $nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $role_responsable = NULL, $role_examinateur = NULL, $role_etudiant = NULL, $login = NULL, $password = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->role_responsable = $role_responsable;
            $this->role_examinateur = $role_examinateur;
            $this->role_etudiant = $role_etudiant;
            $this->login = $login;
            $this->password = $password;
        }
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getRoleResponsable() { return $this->role_responsable; }
    public function getRoleExaminateur() { return $this->role_examinateur; }
    public function getRoleEtudiant() { return $this->role_etudiant; }
    public function getLogin() { return $this->login; }

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
    public static function getById($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $result = $statement->fetchObject("ModelPersonne");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Vérifie login et mot de passe
    public static function checkLogin($login, $password) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE login = :login AND password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login,
                'password' => $password // ⚠ En production, on utiliserait password_hash/verify
            ]);
            $result = $statement->fetchObject("ModelPersonne");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function getAllExaminateurs() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE role_examinateur = 1";
            $statement = $database->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    // Insère une nouvelle personne
    public static function insert($nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password) {
        try {
            $database = Model::getInstance();
            $query1 = "SELECT MAX(id) FROM personne";
            $statement = $database->query($query1);
            $number= $statement->fetch();
            $id = $number['0'];
            $id++;
            $query = "INSERT INTO personne (id,nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password) 
                      VALUES (:id, :nom, :prenom, :respo, :exam, :etud, :login, :password)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'respo' => $role_responsable,
                'exam' => $role_examinateur,
                'etud' => $role_etudiant,
                'login' => $login,
                'password' => $password
            ]);
            return $database->lastInsertId();
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function insertExaminateur($nom, $prenom) {
        try {
            $database = Model::getInstance();
            $query1 = "SELECT MAX(id) FROM personne";
            $statement = $database->query($query1);
            $number= $statement->fetch();
            $id = $number['0'];
            $id++;

            $query = "INSERT INTO personne (id,nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password)
                  VALUES (:id,:nom, :prenom, 0, 1, 0,:login,:password)";

            $login = strtolower($prenom . '.' . $nom);
            $password = "default";
            $statement = $database->prepare($query);
            $statement->execute([
                'id'=> $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'login'=> $login,
                'password' =>$password
            ]);

            return $database->lastInsertId();
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getExaminateursByProjet($projet_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT personne.id, personne.nom, personne.prenom
                  FROM personne
                  JOIN creneau ON personne.id = creneau.examinateur
                  WHERE creneau.projet = :projet_id";
            $statement = $database->prepare($query);
            $statement->execute(['projet_id' => $projet_id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("Erreur : %s<br/>", $e->getMessage());
            return [];
        }
    }


}
?>
