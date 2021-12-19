<?php
class FilmManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(FilmModel $film)
  {
    $q = $this->_db->prepare('INSERT INTO film(nom, annee, score, vote, path) VALUES(:nom, :annee, :score, :vote, :path)');

    $q->bindValue(':nom', $film->nom());
    $q->bindValue(':annee', $film->annee());
    $q->bindValue(':score', $film->score());
    $q->bindValue(':vote', $film->vote());
    $q->bindValue(':path', $film->path());

    $q->execute();
  }

  public function delete(FilmModel $film)
  {
    $this->_db->exec('DELETE FROM film WHERE id = '.$film->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM film WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new FilmModel($donnees);
  }

  public function removeActor($idFilm, $idActeur){
    $q = $this ->_db -> prepare('DELETE FROM casting WHERE idFilm = :idFilm AND idActeur = :idActeur');
    $q->bindvalue(':idFilm', $idFilm);
    $q->bindValue(':idActeur', $idActeur);
    $q->execute();

    return $q->fetchAll();
  }

  public function getActorsWithFilm($id){
    $id = intval($id);
    $acteurs = null;
    $q = $this ->_db -> prepare('SELECT a.id, a.nom, a.prenom FROM acteur a, casting c WHERE a.id = c.idActeur AND c.idFilm = :id');
    $q->bindvalue(':id', $id);
    $q->execute();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $acteurs[] = new ActeurModel($donnees);
    }

    return $acteurs;
  }

  public function getList()
  {
    $films = [];

    $q = $this->_db->query('SELECT * FROM film ORDER BY nom');
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $films[] = new FilmModel($donnees);
    }

    return $films;
  }

  public function update(FilmModel $film)
  {
    $q = $this->_db->prepare('UPDATE film SET nom = :nom, annee = :annee, score = :score, vote = :vote, path = :path WHERE id = :id');

    $q->bindValue(':nom', $film->nom());
    $q->bindValue(':annee', $film->annee());
    $q->bindValue(':score', $film->score());
    $q->bindValue(':vote', $film->vote());
    $q->bindValue(':path', $film->path());
    $q->bindValue(':id', $film->id());

    $q->execute();
  }

}
?>