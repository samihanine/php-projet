<?php
class FilmController {

    protected $manager;
    protected $view;

    public function __construct(FilmManager $manager, ViewFilm $view){
        $this->manager = $manager;
        $this->view = $view;
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
            $user = null;
            if(isset($_SESSION["loggedUser"])){
                $user = unserialize($_SESSION["loggedUser"]);
            }
            return $this->view->display_update($film, $user);
        }
        return "Aucun film.";
    }

}

?>