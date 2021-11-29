<?php
class CastingManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(CastingModel $casting)
  {
    $q = $this->_db->prepare('INSERT INTO casting(idFilm, idActeur) VALUES(:idFilm, :idActeur)');

    $q->bindValue(':idFilm', $casting->idActeur());
    $q->bindValue(':idActeur', $casting->idActeur());

    $q->execute();
  }

  public function delete(CastingModel $casting)
  {
    $this->_db->exec('DELETE FROM casting WHERE id = '.$casting->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM casting WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new CastingModel($donnees);
  }

  public function getList()
  {
    $castings = [];

    $q = $this->_db->query('SELECT * FROM casting ORDER BY idFilm');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $castings[] = new CastingModel($donnees);
    }

    return $castings;
  }

  public function update(CastingModel $casting)
  {
    $q = $this->_db->prepare('UPDATE casting SET idFilm = :idFilm, idActeur = :idActeur WHERE id = :id');

    $q->bindValue(':idFilm', $casting->idFilm());
    $q->bindValue(':idActeur', $casting->idActeur());
    $q->bindValue(':id', $casting->id());

    $q->execute();
  }

}
?>