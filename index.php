<?php
include "vue/layout.php";
include "db_manager.php";

include "vue/ViewFilm.php";
include "controllers/FilmController.php";
include "models/FilmManager.class.php";
include "models/FilmModel.class.php";

include "vue/ViewActeur.php";
include "controllers/ActeurController.php";
include "models/ActeurManager.class.php";
include "models/ActeurModel.class.php";

include "vue/ViewUser.php";
include "controllers/UserController.php";
include "models/UserManager.class.php";
include "models/UserModel.class.php";

session_start();

$path = $_SERVER['REQUEST_URI'];
$path = explode('/', $path);
$path = $path[sizeof($path)-1];
$path = explode('?', "$path")[0];

$title = "";
$content = "";

$acteur_manager = new ActeurManager($bdd);
$film_manager = new FilmManager($bdd);
$user_manager = new UserManager($bdd);

$view_acteur = new ViewActeur();
$view_film = new ViewFilm();
$view_user = new ViewUser();

$acteur_controller = new ActeurController($acteur_manager, $view_acteur);
$film_controller = new FilmController($film_manager, $view_film);
$user_controller = new UserController($user_manager, $view_user);

switch ($path) {
    // view Users
    case 'auth':
        $title = "S'identifier";
        $content = $user_controller->display_auth();
        break;
    case 'disconnect':
        $title = "Déconnexion réussie";
        $content = $view_user->disconnect();
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
        $content = $acteur_controller->display_all();
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
    case 'infos-film':
        $title = "Infos du film";
        $content = $film_controller->display_update();
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
        $content = $film_controller->display_all();
        break;
}

layout($title, $content);

?>