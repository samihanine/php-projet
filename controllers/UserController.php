<?php
class UserController {

    protected $manager;
    protected $view;

    public function __construct(UserManager $manager, ViewUser $view){
        $this->manager = $manager;
        $this->view = $view;
    }

    public function display_auth(){
        if(isset($_POST["email"]) && isset($_POST["pwd"])){
            $user = $this->manager->auth($_POST["email"], $_POST["pwd"]);
            $_SESSION["loggedUser"] = serialize($user);
            return $this->view->display_auth_result($user);
        }else{
            return $this->view->display_auth();
        }
    }

}

?>