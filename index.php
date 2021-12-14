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

echo basename(__DIR__);
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
    case 'add-actor':
        $title = "Acteur ajouté";
        $content = $acteur_controller->display_add_actor();
        break;
    case 'acteur':
        $title = "Acteurs";
        $content = $acteur_controller->display_all();
        break;
    case 'create-acteur':
        $title = "Ajouter un acteur";
        $content = $acteur_controller->display_create();
        break;
    case 'infos-acteur':
        $title = "Détails des acteurs";
        $content = $acteur_controller->display_update();
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
    case 'create-film':
        $title = "Ajouter un film";
        $content = $film_controller->display_create();
        break;
    case 'infos-film':
        $title = "Infos du film";
        $content = $film_controller->display_update();
        break;
    case 'delete-film':
        $title = "Supprimer un film";
        $content = $view_film->display_delete();
    break;
    case 'vote-film':
        $title = "Voter pour un film";
        $content = $view_film->display_vote();
    break;
    case 'remove-actor':
        $title = "Acteur retiré";
        $content = $film_controller->display_delete_actor_from_movie();
        break;
    default:
        $title = "Détails des films";
        $content = $film_controller->display_all();
        break;
}

layout($title, $content);

?>

<style>
    .user-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        border:none;
    }

    .user-input[type=number], .user-input {
        -moz-appearance: textfield;
        margin: 0;
        border:none;
        color: black
    }
</style>