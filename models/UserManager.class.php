<?php
class UserManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(UserModel $user)
  {
    $q = $this->_db->prepare('INSERT INTO users(email, pwd, privilege) VALUES(:email, :pwd, :privilege)');

    $q->bindValue(':email', $user->email());
    $q->bindValue(':pwd', $user->pwd());
    $q->bindValue(':privilege', 0);

    $q->execute();
  }

  public function delete(UserModel $user)
  {
    $this->_db->exec('DELETE FROM users WHERE id = '.$user->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM users WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new UserModel($donnees);
  }

  public function getList()
  {
    $users = [];

    $q = $this->_db->query('SELECT * FROM users ORDER BY nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new UserModel($donnees);
    }

    return $users;
  }

  public function update(UserModel $user)
  {
    $q = $this->_db->prepare('UPDATE users SET email = :email, pwd = :pwd, privilege = :privilege WHERE id = :id');

    $q->bindValue(':email', $user->email());
    $q->bindValue(':pwd', $user->pwd());
    $q->bindValue(':privilege', $user->privilege());
    $q->bindValue(':id', $user->id());

    $q->execute();
  }

  public function auth($email, $pwd)
  {

    $q = $this->_db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue(':email', $email);
    $q->execute();

    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    if($donnees && password_verify($pwd, $donnees["pwd"])){
      return new UserModel($donnees);
    }
    return null;
  }

  public function register(UserModel $newUser){
    $q = $this->_db->prepare("INSERT INTO users(email, pwd) VALUES(:email, :pwd)");
    $q->bindValue(":email", $newUser->email());
    $q->bindValue(":pwd", $newUser->pwd());

    $q->execute();
  }
}


?>