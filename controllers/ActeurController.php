<?php


class ActeurController {

    protected $manager;
    protected $view;

    public function __construct(ActeurManager $manager, ViewActeur $view){
        $this->manager = $manager;
        $this->view = $view;
    }

    // public function add_acteur() {
    //     $result = '';

    //     if (!isset($_POST["nom"])) {
    //         $result = $this->view->display_add_acteur();
    //     } else {
    //         $acteur = new ActeurModel($_POST);
    //         $this->manager->add($acteur);

    //         $result = $this->view->display_add_acteur_result();
    //     }

    //     return $result;
    // }

    public function display_create(){
        $user = null;
        if(isset($_SESSION["loggedUser"])){
            $user = unserialize($_SESSION["loggedUser"]);
        }
        if($user && $user->privilege() > 0){


            if(isset($_POST["nom"]) && isset($_POST["prenom"])){
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $this->manager->add($nom, $prenom);
                return $this->view->display_create_result();
            }else{
                return $this->view->display_create();
            }

        }
    }

    public function display_add_actor(){
        $user = null;
        if(isset($_SESSION["loggedUser"])){
            $user = unserialize($_SESSION["loggedUser"]);
        }
        if($user && $user->privilege() > 0 && isset($_GET["idfilm"]) && !isset($_GET["newactor"])){
            $idFilm = intval($_GET["idfilm"]);
            $acteurs = $this->manager->getListWhereNotFilm($idFilm);

            return $this->view->display_add_actor($acteurs, $idFilm);

        }elseif($user && $user->privilege() > 0 && isset($_GET["idfilm"]) && isset($_GET["newactor"])){

            $this->manager->addActorToFilm(intval($_GET["idfilm"]), intval($_GET["newactor"]));

            return $this->view->display_add_actor_result(intval($_GET["idfilm"]));
        }else{
            header("location: films");
        }
        return "Aucun film séléctionné.";
    }

    public function display_update(){
        if(isset($_GET["id"])){
            $id = intval($_GET["id"]);

            $acteur = $this->manager->get($id);

            $films = $this->manager->getFilmsWithActor($id);

            $user = null;
            if(isset($_SESSION["loggedUser"])){
                $user = unserialize($_SESSION["loggedUser"]);
            }
            return $this->view->display_update($films, $acteur, $user);
        }
        return "Aucun film.";
    }

    public function display_all() {
        $acteurs = $this->manager->getList();

        $result = $this->view->display_all($acteurs);

        return $result;
    }
}

?>