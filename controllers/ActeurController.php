<?php
class ActeurController {

    protected $manager;
    protected $view;

    public function add_acteur() {
        $result = '';

        if (!isset($_POST["nom"])) {
            $result = $this->view->display_add_acteur();
        } else {
            $acteur = new ActeurModel($_POST);
            $this->manager->add($acteur);

            $result = $this->view->display_add_acteur_result();
        }

        return $result;
    }

    public function display_acteur() {
        $list = $this->manager->getList();

        $result = $this->view->display_acteur($list);

        return $result;
    }
}

?>