<?php
class CastingModel
{
    protected $id,
        $idFilm,
        $idActeur;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }


    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function id()
    {
        return $this->id;
    }

    public function idFilm()
    {
        return $this->idFilm;
    }

    public function idActeur()
    {
        return $this->idActeur;
    }

    public function setId($id)
    {
        $id = (int) $id;

        if($idFilm > 0){
            $this->id = $id;
        }
    }

    public function setIdfilm($idFilm)
    {
        $idFilm = (int) $idFilm;

        if ($idFilm > 0) {
            $this->idFilm = $idFilm;
        }
    }

    public function setIdacteur($idActeur)
    {
        $idActeur = (int) $idActeur;

        if ($idActeur > 0) {
            $this->idActeur = $idActeur;
        }
    }
?>