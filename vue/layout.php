<?php
function layout($title, $content) {

    echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <title>'. $title. '</title>
        </head>
        <body>
            <header>';
                '<nav>
                    <ul>';
                    echo '<li><a href="film">Détails Films</a></li>';
                    echo '<li><a href="acteur">Détails Acteurs</a></li>';
                    if(isset($_SESSION["loggedUser"])){
                        $user = unserialize($_SESSION["loggedUser"]);
                        if($user){
                            if($user->privilege() == 1){
                                echo '<li><a href="add-acteur">Ajouter un Acteur</a></li>';
                                echo '<li><a href="add-film">Ajouter un Film</a></li>';
                            }
                            echo '<li><a href="disconnect">Se déconnecter</a></li>';
                            echo "<p>Connecté avec l'email " . $user->email() . ".</p>";
                        }
                    }else{
                        echo '<li><a href="auth">Se connecter</a></li>';
                        
                    }
                    echo '</ul>
                </nav>
            </header>

            '.$content.'
        </body>
    </html>';
}
?>