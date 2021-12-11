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
        
        return $this->view->display_all($films);
    }

}

?>