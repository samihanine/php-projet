<?php
class UserController {

    protected $manager;
    protected $view;

    public function __construct(UserManager $manager, ViewUser $view){
        $this->manager = $manager;
        $this->view = $view;
    }

    /**
     * identifie un utilisateur et l'insère dans le session storage
     * @param void
     * @return string
     * @access private 
     */

    public function register(){
        if(isset($_POST["email"]) && isset($_POST["pwd"]) && isset($_POST["cmdp"])){

            $email = $_POST["email"];
            $pwd = $_POST["pwd"];

            //password check :
            $length = strlen($pwd) >= 8;
            $maj = preg_match('@[A-Z]@', $pwd);
            $min = preg_match('@[a-z]@', $pwd);
            $number = preg_match('@[0-9]@', $pwd);

            if($pwd !== $_POST["cmdp"]){
                return $this->view->display_register(2);
            }

            if(!$length || !$maj || !$min || !$number){
                return $this->view->display_register(1);
            }

            unset($_POST["cmdp"]);

            $_POST["pwd"] = password_hash($pwd, PASSWORD_BCRYPT);
            $newUser = new UserModel($_POST);

            $this->manager->add($newUser);

            return $this->view->display_register_result();
        }
        return $this->view->display_register(null);
    }

    public function auth(){
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