<?php
class FilmModel
{
    protected $id,
        $nom,
        $annee,
        $vote,
        $score,
        $path;


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

    public function nomValide()
    {
        return !empty($this->nom);
    }

    public function nom()
    {
        return $this->nom;
    }

    public function annee()
    {
        return $this->annee;
    }

    public function score()
    {
        return $this->score;
    }

    public function vote()
    {
        return $this->vote;
    }

    public function id()
    {
        return $this->id;
    }

    public function path()
    {
        return $this->path;
    }

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }

    public function setPath($path)
    {
        if (is_string($path)) {
            $this->path = $path;
        }
    }

    public function setAnnee($annee)
    {
        if (is_string($annee)) {
            $this->annee = $annee;
        }
    }

    public function setVote()
    {
        $this->vote++;
    }

    public function setScore($score)
    {
        $score = floatval($score);
        if ($score  > 0) {
            $this->score = $score;
        }
    }
}
?>