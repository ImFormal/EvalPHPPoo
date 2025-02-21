<?php

class ModelPlayer implements InterfaceModel {
    //ATTRIBUTS
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?int $score;
    private ?string $password;
    private ?PDO $bdd;

    public function __construct(){
        $this->bdd = connect();
    }

    //GETTER ET SETTER
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): ModelPlayer {
        $this->id = $id;
        return $this;
    }

    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): ModelPlayer {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): ModelPlayer {
        $this->email = $email;
        return $this;
    }

    public function getScore(): ?int {
        return $this->score;
    }

    public function setScore(?int $score): ModelPlayer {
        $this->score = $score;
        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): ModelPlayer {
        $this->password = $password;
        return $this;
    }

    public function getBdd(): ?PDO {
        return $this->bdd;
    }

    public function setBdd(): ModelPlayer {
        $this->bdd = connect();
        return $this;
    }

    //METHOD
    public function add(): string{

        try{
            $bdd = $this->getBdd();

            $requete = "INSERT INTO players(pseudo, email, score, `pssword`) VALUE(?,?,?,?)";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $this->pseudo, PDO::PARAM_STR);
            $req->bindParam(2,  $this->email, PDO::PARAM_STR);
            $req->bindParam(3, $this->score, PDO::PARAM_STR);
            $req->bindParam(4, $this->password, PDO::PARAM_STR);
            
            if($req->execute()){
                return "Enregistrement de l'utilisateur avec succès !";
            }

            return "Enregistrement échoué !";
        }
        catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return "Enregistrement échoué !";
        }
    }

    public function getAll(): array|null {

        try{
            $bdd = $this->getBdd();

            $requete = "SELECT id, pseudo, email, score FROM players";
            $req = $bdd->prepare($requete);
            $req->execute();
            
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) {
            echo "". $e->getMessage();
            return null;
        }
    }

    public function getByEmail(): array|null {

        try{
            $bdd = $this->getBdd();
            $email = $this->getEmail();

            $requete = "SELECT id, pseudo, email, score FROM players WHERE email = ?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $email, PDO::PARAM_STR);
            $req->execute();
            
            return $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e) {
            echo "". $e->getMessage();
            return null;
        }
    }
}