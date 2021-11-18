<?php
    require_once("bdd.php");

    abstract class Film {
        function __construct($email, $pwd) {
            global $bdd;

            $query = $bdd -> prepare('select * from user where email=? and pwd=?');
            $query -> execute(array($email, $pwd));

            if (isset($querry)) {
                $this->id = $query['id'];
                $this->login = $query['login'];
                $this->pwd = $query['pwd'];
                $this->email = $query['email'];
                $this->privilege = $query['privilege'];

                session_start();
                $_SESSION['user'] = $this;
                header("Location: pages/home.php");
            }
        }



    }

?>