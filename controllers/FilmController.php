<?php

class FilmController
{

    protected $manager;
    protected $view;

    public function __construct(FilmManager $manager, ViewFilm $view)
    {
        $this->manager = $manager;
        $this->view = $view;
    }

    /**
     * supprime le lien entre un acteur et un film
     * @param void
     * @return string
     * @access private 
     */
    public function delete_actor_from_movie()
    {
        if (isset($_GET["idacteur"]) && isset($_GET["idfilm"])) {
            $idFilm = intval($_GET["idfilm"]);
            $idActeur = intval($_GET["idacteur"]);

            $this->manager->removeActor($idFilm, $idActeur);
            if ($_GET["redirect"] == "film") {
                header("location: infos-film?id=" . $idFilm);
            } elseif ($_GET["redirect"] == "acteur") {
                header("location: infos-acteur?id=" . $idActeur);
            }
            die();
        }
    }

    /**
     * permet d'afficher l'ensemble des film
     * @param void
     * @return string
     * @access public
     */
    public function all()
    {
        $films = $this->manager->getList();
        $user = null;
        if (isset($_SESSION["loggedUser"])) {
            $user = unserialize($_SESSION["loggedUser"]);
        }
        return $this->view->display_all($films, $user);
    }

    /**
     * modifie un film et/ou d'affiche ses informations
     * @param void
     * @return string
     * @access public
     */
    public function update()
    {
        if (!isset($_GET["id"])) return "Film inexistant.";

        $id = intval($_GET["id"]);
        $film = $this->manager->get($id);
        $acteurs = $this->manager->getActorsWithFilm($id);
        $user = null;
        if (isset($_SESSION["loggedUser"])) {
            $user = unserialize($_SESSION["loggedUser"]);
        }

        if (isset($_POST["nom"]) && isset($_POST["annee"])) {
            $film = new FilmModel($_POST);
            $this->manager->update($film);
        }

        return $this->view->display_update($film, $acteurs, $user);
    }

    /**
     * ajoute un film
     * @param void
     * @return string
     * @access public
     */
    public function create()
    {
        $user = null;
        if (isset($_SESSION["loggedUser"])) {
            $user = unserialize($_SESSION["loggedUser"]);
        }

        if (!($user) && $user->privilege() != 1) {
            return "Mauvais privilèges";
        }

        if (!(isset($_POST["nom"]) && isset($_POST["annee"]))) {
            return $this->view->display_create();
        }

        if (isset($_FILES["userfile"]) && $_FILES["userfile"]["name"] !== "") {
            $file_name = rand() . $_FILES["userfile"]['name'];
            $dir = 'upload/' . $file_name; // upload/toto.txt

            move_uploaded_file($_FILES['userfile']['tmp_name'], $dir);

            $_POST["path"] = $dir;
        } else {
            $_POST["path"] = "";
        }

        $film = new FilmModel($_POST);

        $this->manager->add($film);

        return $this->view->display_create_result();
    }

    /**
     * supprime un film et redirige à la page précédente
     * @param void
     * @return string
     * @access private 
     */
    public function delete()
    {
        if (isset($_GET["id"])) {
            $film = $this->manager->get($_GET["id"]);
            $this->manager->delete($film);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * incrémente d'un le score d'un film
     * @param void
     * @return string
     * @access private 
     */
    public function vote()
    {
        if (isset($_GET["id"])) {
            $film = $this->manager->get($_GET["id"]);
            $film->setScore($film->score() + 1);
            $this->manager->update($film);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
