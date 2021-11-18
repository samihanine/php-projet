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
    $q = $this->_db->prepare('INSERT INTO user(email, pwd, privilege) VALUES(:email, :pwd, :privilege)');

    $q->bindValue(':email', $user->email());
    $q->bindValue(':pwd', $user->pwd());
    $q->bindValue(':privilege', $user->privilege());

    $q->execute();
  }

  public function delete(UserModel $user)
  {
    $this->_db->exec('DELETE FROM user WHERE id = '.$user->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM user WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new UserModel($donnees);
  }

  public function getList()
  {
    $users = [];

    $q = $this->_db->query('SELECT * FROM user ORDER BY nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new UserModel($donnees);
    }

    return $users;
  }

  public function update(UserModel $user)
  {
    $q = $this->_db->prepare('UPDATE user SET email = :email, pwd = :pwd, privilege = :privilege WHERE id = :id');

    $q->bindValue(':email', $user->email());
    $q->bindValue(':pwd', $user->pwd());
    $q->bindValue(':privilege', $user->privilege());
    $q->bindValue(':id', $user->id());

    $q->execute();
  }

}
?>