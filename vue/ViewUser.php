<?php
class ViewUser {

    /**
     * affiche le formulaire d'authentification
     * @param void
     * @return string
     * @access public
     */
    public function display_auth(){
        $result = '<main class="admin-input">
        <form method="post" action="auth" autocomplete="off">
            <label for="email">email</label>
            <input name="email" id="email" type="text" required />

            <label for="pwd">Mot de passe</label>
            <input name="pwd" id="pwd" type="password" required />

            <button type="submit">Se connecter</button>
        </form>
        </main>';
        return $result;
    }

    /**
     * affiche le résultat de l'authentification
     * @param void
     * @return string
     * @access public
     */
    public function display_auth_result($user){
        $result = '<p>Votre email ou votre mot de passe est incorrect.</p>';
        if ($user != null) {
            $result = '<p>Connexion réussi !</p>';
        }

        return $result;
    }

    /**
     * affiche le formulaire d'inscription
     * @param void
     * @return string
     * @access public
     */
    public function display_register($errorCode){
        $result = '<main>
        <form method="post" autocomplete="off" action="register">
            <label>Email</label>
            <input name="email" id="email" type="email" required />
            <label>Mot de Passe :</label>
            <input name="pwd" id="mdp" type="password" required />
            <label>Confirmation du mot de passe :</label>
            <input name="cmdp" id="cmdp" type="password" required />
            <button type="submit">Créer le compte</button>
        </form>
        </main>';

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

    /**
     * affiche le résultat de l'inscription
     * @param void
     * @return string
     * @access public
     */
    public function display_register_result(){
        return "<p>Super ! Le compte a été créé.</p>";
    }

    /**
     * affiche le résultat de la déconnexion
     * @param void
     * @return string
     * @access public
     */
    public function display_disconnect(){
        $result = '<p>Vous vous êtes déconnecté.</p>
            <p><a href="film">Retourner au menu principal</a></p>';
        
        return $result;
    }

    /**
     * affiche la page lorsque le droit n'a pas le droit d'accéder à une certaine url
     * @param void
     * @return string
     * @access public
     */
    public function display_forbidden(){
        $result = '<p class="forbidden">Alors petit malin ? on veut accéder à un url interdit ?';
        return $result;
    }
}

?>