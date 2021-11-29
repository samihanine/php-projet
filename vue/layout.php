<?php
function layout($title, $content) {
    
    echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <title>'. $title. '</title>
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <li><a href="film">Détails Films</a></li>
                        <li><a href="acteur">Détails Acteurs</a></li>
                        <li><a href="add-acteur">Ajouter un Acteur</a></li>
                        <li><a href="add-film">Ajouter un Film</a></li>
                        <li><a href="disconnect">Se déconnecter</a></li>
                    </ul>
                </nav>
            </header>

            '.$content.'
        </body>
    </html>';
}
?>