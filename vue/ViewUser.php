<?php
class ViewUser {

    public function display_auth(){
        $result = '<form method="post" action="auth">
            <label for="email">email</label>
            <input name="email" id="email" type="text" required />

            <label for="pwd">Mot de passe</label>
            <input name="pwd" id="pwd" type="pwd" required />

            <button type="submit">Se connecter</button>
        </form>';
        return $result;
    }

    public function display_auth_result($user){
        $result = '<p>Votre email ou votre mot de passe est incorrect.</p>';
        if ($user != null) {
            $result = '<p>Connexion réussi !</p>';
        }

        return $result;
    }

    public function display_register($errorCode){
        $result = '
        <form method="post" action="register">
            <label>Email</label>
            <input name="email" id="email" type="email" required />
            <label>Mot de Passe :</label>
            <input name="pwd" id="mdp" type="password" required />
            <label>Confirmation du mot de passe :</label>
            <input name="cmdp" id="cmdp" type="password" required />
            <button type="submit">Créer le compte</button>
        </form>
        ';

        if($errorCode){
            switch($errorCode){
                case(1):
                    $result = $result . "<p>Le mot de passe doit faire au moins 8 caractères, contenir au moins une majuscule, une minuscule et un chiffre. Réessayez.";
                    break;
                case(2):
                    $result = $result . "<p>Les mots de passes ne correspondent pas.</p>";
                    break;
                default:
                    $result = $result . "<p>Erreur.</p>";
                    break;
            }
        }

        return $result;
    }

    public function display_register_result(){
        return "<p>Super ! Le compte a été créé.</p>";
    }

    public function disconnect(){
        unset($_SESSION["loggedUser"]);

        $result = '<p>Vous vous êtes déconnecté.</p>
            <p><a href="film">Retourner au menu principal</a></p>';
        
        return $result;
    }
}

?>