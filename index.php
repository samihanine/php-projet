<?php
include "vue/layout.php";
include "db_manager.php";

include "vue/ViewFilm.php";
include "controllers/FilmManager.class.php";
include "models/FilmModel.class.php";

include "vue/ViewActeur.php";
include "controllers/ActeurManager.class.php";
include "models/ActeurModel.class.php";

include "vue/ViewUser.php";
include "controllers/UserManager.class.php";
include "models/UserModel.class.php";

$path = $_SERVER['REQUEST_URI'];
$path = explode('/', $path);
$path = $path[sizeof($path)-1];
$path = explode('?', "$path")[0];

$title = "";
$content = "";

$acteur_manager = new ActeurManager($bdd);
$film_manager = new FilmManager($bdd);
$user_manager = new UserManager($bdd);

$view_acteur = new ViewActeur($acteur_manager);
$view_film = new ViewFilm($film_manager);
$view_user = new ViewUser($user_manager);

switch ($path) {
    // view Users
    case 'auth':
        $title = "S'identifier";
        $content = $view_user->display_auth();
        break;
    case 'auth-result':
        $title = "S'identifier";
        $content = $view_user->display_auth_result();
        break;
    // view Acteurs
    case 'add-acteur':
        $title = "Ajouter un acteur";
        $content = $view_acteur->display_add();
        break;
    case 'add-acteur-result':
        $title = "Acteur Ajouté";
        $content = $view_acteur->display_add_result();
        break;
    case 'acteur':
        $title = "Détails des acteurs";
        $content = $view_acteur->display_all();
        break;
    case 'update-acteur':
        $title = "Modifier un acteur";
        $content = $view_acteur->display_update();
        break;
    case 'delete-acteur':
        $title = "Supprimer un acteur";
        $content = $view_acteur->display_delete();
    break;
    case 'update-acteur-result':
        $title = "Modifier un acteur";
        $content = $view_acteur->display_update_result();
    break;
    // views Film
    case 'add-film':
        $title = "Ajouter un film";
        $content = $view_film->display_add();
        break;
    case 'add-film-result':
        $title = "Film Ajouté";
        $content = $view_film->display_add_result();
        break;
    case 'update-film':
        $title = "Modifier un film";
        $content = $view_film->display_update();
        break;
    case 'delete-film':
        $title = "Supprimer un film";
        $content = $view_film->display_delete();
    break;
    case 'update-film-result':
        $title = "Modifier un film";
        $content = $view_film->display_update_result();
    break;
    case 'vote-film':
        $title = "Voter pour un film";
        $content = $view_film->display_vote();
    break;
    default:
        $title = "Détails des films";
        $content = $view_film->display_all();
        break;
}

layout($title, $content);

?>