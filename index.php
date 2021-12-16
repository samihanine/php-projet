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

$user = null;
$privilege = -1;

if (isset($_SESSION["loggedUser"])) {
    $user = unserialize($_SESSION["loggedUser"]);
    if ($user) {
        $privilege = $user->privilege();
    }
}

switch ($path) {
    // view Users
    case 'auth':
        $title = "S'identifier";
        $content = $user_controller->auth();
        break;
    case 'register':
        $title = "S'inscire";
        $content = $user_controller->register();
        break;
    case 'disconnect':
        $title = "Déconnexion réussie";
        $content = $user_controller->disconnect();
        break;
    // view Acteurs
    case 'acteur':
        $title = "Acteurs";
        $content = $acteur_controller->all();
        break;
    case 'create-acteur':
        if ($privilege != 1) {
            header('location: forbidden');
            die();
        }
        $title = "Ajouter un acteur";
        $content = $acteur_controller->create();
        break;
    case 'infos-acteur':
        $title = "Détails des acteurs";
        $content = $acteur_controller->update();
        break;
    case 'delete-acteur':
        if ($privilege != 1) {
            header('location: forbidden');
            die();
        }
        $title = "Supprimer un acteur";
        $content = $acteur_controller->delete();
    break;
    // views Film
    case 'create-film':
        $title = "Ajouter un film";
        $content = $film_controller->create();
        break;
    case 'infos-film':
        $title = "Infos du film";
        $content = $film_controller->update();
        break;
    case 'delete-film':
        if ($privilege != 1) {
            header('location: forbidden');
            die();
        }
        $title = "Supprimer un film";
        $content = $film_controller->delete();
    break;
    case 'vote-film':
        if ($privilege == -1) {
            header('location: forbidden');
            die();
        }
        $title = "Voter pour un film";
        $content = $film_controller->vote();
    break;
    case 'add-actor':
        if ($privilege != 1) {
            header('location: forbidden');
            die();
        }
        $title = "Ajouter un acteur au film";
        $content = $acteur_controller->add_actor();
        break;
    case 'remove-actor':
        if ($privilege != 1) {
            header('location: forbidden');
            die();
        }
        $title = "Acteur retiré";
        $content = $film_controller->delete_actor_from_movie();
        break;
    case 'forbidden':
        $title = "Accès interdit";
        $content = $view_user->display_forbidden();
        break;
    default:
        $title = "Détails des films";
        $content = $film_controller->all();
        break;
}

layout($title, $content);

?>

