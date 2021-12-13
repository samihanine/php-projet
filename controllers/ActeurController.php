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