<?php
class ViewUser {

    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function display_auth(){
        $result = '<form method="post" action="auth-result">
            <label for="email">email</label>
            <input name="email" id="email" type="text" required />

            <label for="pwd">Mot de passe</label>
            <input name="pwd" id="pwd" type="pwd" required />

            <button type="submit">Se connecter</button>
        </form>';

        return $result;
    }

    public function display_auth_result(){
        $result = '<p>Votre email ou votre mot de passe est incorrect.</p>';

        if (isset($_POST["email"]) && isset($_POST["pwd"])) {
            $user = $this->controller->auth($_POST["email"], $_POST["pwd"]);

            if ($user != null) {
                $result = '<p>Connexion réussi !</p>';
            }
        }

        return $result;
    }

    public function register(){
        $result = "";

        return $result;
    }
}

?>