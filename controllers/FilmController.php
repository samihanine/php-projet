<?php
class FilmController {

    protected $manager;
    protected $view;

    public function __construct(FilmManager $manager, ViewFilm $view){
        $this->manager = $manager;
        $this->view = $view;
    }



    public function display_delete_actor_from_movie(){
        if(isset($_GET["idacteur"]) && isset($_GET["idfilm"])){
            $idFilm = intval($_GET["idfilm"]);
            $idActeur = intval($_GET["idacteur"]);

            $this->manager->removeActor($idFilm, $idActeur);
            if($_GET["redirect"]=="film")
                {header("location: infos-film?id=" . $idFilm);}
            elseif($_GET["redirect"]=="acteur")
                {header("location: infos-acteur?id=" . $idActeur);

                }
            die();
        }
    }

    public function display_all(){
        $films = $this->manager->getList();
        $user = null;
        if(isset($_SESSION["loggedUser"])){
            $user = unserialize($_SESSION["loggedUser"]);
        }
        return $this->view->display_all($films, $user);
    }

    public function display_update(){
        if(isset($_GET["id"])){
            $id = intval($_GET["id"]);
            $film = $this->manager->get($id);
            $acteurs = $this->manager->getActorsWithFilm($id);
            $user = null;
            if(isset($_SESSION["loggedUser"])){
                $user = unserialize($_SESSION["loggedUser"]);
            }
            return $this->view->display_update($film, $acteurs, $user);
        }
        return "Film inexistant.";
    }

}

?>