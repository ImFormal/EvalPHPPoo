<?php

class ViewPlayer {
    //ATTRIBUTS
    private ?string $signUpMessage = '';
    private ?string $playersList = '';

    //GETTER ET SETTER
    public function getSignUpMessage(): ?string {
        return $this->signUpMessage;
    }

    public function setSignUpMessage(?string $signUpMessage): ViewPlayer {
        $this->signUpMessage = $signUpMessage;
        return $this;
    }

    public function getPlayersList(): ?string {
        return $this->playersList;
    }
    public function setPlayersList(?string $playersList): ViewPlayer {
        $this->playersList = $playersList;
        return $this;
    }

    //METHOD
    public function displayView(): string {
        ob_start();
    ?>
        <section>
            <h1>Inscription d'un Joueur</h1>
            <form action="" method="post">
                <input type="text" name="pseudo" placeholder="Votre Pseudo">
                <input type="email" name="email" placeholder="Votre Email">
                <input type="password" name="password" placeholder="Votre Mot de Passe">
                <input type="number" name="score" placeholder="Votre Score">
                <input type="submit" name="submitAdd" value="Envoyer">
            </form>
            <?php if(!empty($this->getSignUpMessage())): ?>
                <p><?php echo $this->getSignUpMessage(); ?></p>
            <?php endif; ?>
        </section>
    
        <section>
            <h1>Liste des Joueurs</h1>
            <ul>
                <?php echo $this->getPlayersList(); ?>
            </ul>
        </section>
    <?php
        return ob_get_clean();
    }
}