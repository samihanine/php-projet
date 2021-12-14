<?php
// DTO
class ActeurManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(ActeurModel $acteur)
  {
    $q = $this->_db->prepare('INSERT INTO acteur(nom, prenom) VALUES(:nom, :prenom)');

    $q->bindValue(':nom', $acteur->nom());
    $q->bindValue(':prenom', $acteur->prenom());

    $q->execute();
  }

  public function delete(ActeurModel $acteur)
  {
    $this->_db->exec('DELETE FROM acteur WHERE id = '.$acteur->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM acteur WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new ActeurModel($donnees);
  }

  public function getFilmsWithActor($id){
    $id = intval($id);
    $films = null;
    $q = $this ->_db -> prepare('SELECT a.id, a.nom, a.annee, a.score, a.vote FROM film a, casting c WHERE a.id = c.idFilm AND c.idActeur = :id');
    $q->bindvalue(':id', $id);
    $q->execute();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $films[] = new FilmModel($donnees);
    }

    return $films;
  }

  public function addActorToFilm($idfilm, $idacteur){
    $q = $this -> _db -> prepare('INSERT INTO casting(idFilm, idActeur) VALUES(:idFilm, :idActeur)');
    $q->bindValue(":idFilm", $idfilm);
    $q->bindValue(":idActeur", $idacteur);
    $q->execute();
  }

  public function getListWhereNotFilm($idfilm){
    $acteurs = null;
    $q = $this ->_db -> prepare('SELECT * FROM acteur WHERE id NOT IN (SELECT idActeur FROM casting WHERE idFilm = :id); ');
    $q->bindvalue(':id', $idfilm);
    $q->execute();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $acteurs[] = new ActeurModel($donnees);
    }

    return $acteurs;
  }


  public function getList()
  {
    $acteurs = [];

    $q = $this->_db->query('SELECT * FROM acteur ORDER BY nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $acteurs[] = new ActeurModel($donnees);
    }

    return $acteurs;
  }

  public function update(ActeurModel $acteur)
  {
    $q = $this->_db->prepare('UPDATE acteur SET nom = :nom, prenom = :prenom WHERE id = :id');

    $q->bindValue(':nom', $acteur->nom());
    $q->bindValue(':prenom', $acteur->prenom());
    $q->bindValue(':id', $acteur->id());

    $q->execute();
  }

}
?>