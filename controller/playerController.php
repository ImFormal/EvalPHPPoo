<?php

class PlayerController extends AbstractController {
    //ATTRIBUTS
    private ViewPlayer $player;

    public function __construct(ViewHeader $header, ViewFooter $footer, InterfaceModel $model) {
        $this->setHeader($header);
        $this->setFooter($footer);
        $this->setModel($model);
        $this->player = new ViewPlayer(); 
    }

    //GETTER ET SETTER
    public function getPlayer(): ViewPlayer {
        return $this->player;
    }
    

    public function setPlayer(): PlayerController {
        $this->player = new ViewPlayer(); 
        return $this;
    }

    //METHOD
    public function addPlayers(): string{
        $message = "";
        // Lors de l'ajout
        if(isset($_POST['submitAdd'])){

            // Check si les champs sont remplis
            if( !empty($_POST['pseudo']) && 
                !empty($_POST['email']) && 
                !empty($_POST['score']) &&
                !empty($_POST['password'])
            ){

                // Check le format du mdp
                $password = $_POST['password'];
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                
                if($uppercase && $lowercase && $number && $specialChars && strlen($password) > 8) {

                    // Nettoyage des entrées
                    $pseudo = sanitize($_POST['pseudo']);
                    $email = sanitize($_POST['email']);

                    // Check si le joueur n'existe pas
                    if(!$this->getModel()['pseudo']->getByEmail()) {

                        // Hashage du mdp
                        $hash = password_hash(sanitize($password), PASSWORD_DEFAULT);

                        // Stockage des infos
                        $player = [$pseudo, $email, $hash];
                        $this->getModel()['pseudo']->setPlayer($player)->add();
                    }

                    else {
                        $message = '<li>Joueur déjà existant en bdd</li>';
                    }
                }
                else {
                    if(!$uppercase){
                        $message . '<li>Le mot de passe doit contenir une majuscule</li>';
                    }
                    if(!$lowercase){
                        $message . '<li>Le mot de passe doit contenir une minuscule</li>';
                    }
                    if(!$number){
                        $message . '<li>Le mot de passe doit contenir un chiffre</li>';
                    }
                    if(!$specialChars){
                        $message . '<li>Le mot de passe doit contenir un caractère spécial</li>';
                    }
                    if(strlen($password) < 8){
                        $message . '<li>Le mot de passe doit contenir au moins 8 caractères</li>';
                    }
                }
            }
            else {
                $message = '<li>Veuillez remplir tous les champs</li>';
            }
        }
        return $message;
    }
    public function getAllPlayers(): string {
        // Récupération de tous les joueurs dans la bdd
        $data = $this->getModel()->getAll();
        $listUsers = "";
        foreach($data as $joueur){
            $listUsers = $listUsers."<li><h4>".$joueur['pseudo'] ." ". $joueur['email']."</h4>      <p>".$joueur['score']."</p></li>";
        }
        return $listUsers;
    }
    public function render(): void {
        $this->renderHeader();
        $message = $this->addPlayers();
        echo $this->getPlayer()->setSignUpMessage($message)->setPlayersList($this->getAllPlayers())->displayView();
        $this->renderFooter();
    }
}   