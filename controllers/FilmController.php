<?php

class FilmController {

    protected $manager;
    protected $view;

    public function __construct(FilmManager $manager, ViewFilm $view){
        $this->manager = $manager;
        $this->view = $view;
    }

    /**
     * supprime la ligne reliant un acteur à un film dans la table casting
     * @param void
     * @return string
     * @access private 
    */
    public function delete_actor_from_movie(){
        if(isset($_GET["idacteur"]) && isset($_GET["idfilm"])){
            $idFilm = intval($_GET["idfilm"]);
            $idActeur = intval($_GET["idacteur"]);

            $this->manager->removeActor($idFilm, $idActeur);
            if($_GET["redirect"]=="film")
                {header("location: infos-film?id=" . $idFilm);}
            elseif($_GET["redirect"]=="acteur") {
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
    public function all(){
        $films = $this->manager->getList();
        $user = null;
        if(isset($_SESSION["loggedUser"])){
            $user = unserialize($_SESSION["loggedUser"]);
        }
        return $this->view->display_all($films, $user);
    }

    /**
     * permet de modifier un film et d'afficher ses informations
     * @param void
     * @return string
     * @access public
    */
    public function update(){
        if(isset($_GET["id"])){
            $id = intval($_GET["id"]);
            $film = $this->manager->get($id);
            $acteurs = $this->manager->getActorsWithFilm($id);
            $user = null;
            if(isset($_SESSION["loggedUser"])){
                $user = unserialize($_SESSION["loggedUser"]);
            }

            if(isset($_POST["nom"]) && isset($_POST["annee"])){ 
                $film = new FilmModel($_POST);
                $this->manager->update($film);
            }

            return $this->view->display_update($film, $acteurs, $user);
        }
        return "Film inexistant.";
    }

    /**
     * permet de créer un film
     * @param void
     * @return string
     * @access public
    */
    public function create(){
        $user = null;
        if(isset($_SESSION["loggedUser"])){
            $user = unserialize($_SESSION["loggedUser"]);
        }
        
        if(!($user) && $user->privilege() != 1) {
            return "Mauvais privilèges";
        }
            
        if(!(isset($_POST["nom"]) && isset($_POST["annee"]))){ 
            return $this->view->display_create();
        }
        
        if (isset($_FILES["userfile"])) {
            $file_name = rand().$_FILES["userfile"]['name'];
            $dir = 'upload/'.$file_name;

            move_uploaded_file($_FILES['userfile']['tmp_name'], $dir);

            $_POST["path"] = $dir;
        } else {
            $_POST["path"] = "";
        }

        $film = new FilmModel($_POST);
   
        $this->manager->add($film);

        return $this->view->display_create_result();
    }

    public function delete() {
        if (isset($_GET["id"])) {
            $film = $this->manager->get($_GET["id"]);
            $this->manager->delete($film);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function vote() {
        if (isset($_GET["id"])) {
            $film = $this->manager->get($_GET["id"]);
            $film->setScore($film->score + 1);
            $this->manager->update($film);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

}
