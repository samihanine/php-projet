<?php
class ViewFilm {

    private $controller;

    public function __construct() {
       
    }

    public function display_update(){
        $film = $this->controller->get($_GET["id"]);

        $result = '
            <form method="post" action="update-film-result">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" value="'.$film->nom.'" required />

            <label for="annee">annee</label>
            <input name="annee" id="annee" type="number" value="'.$film->annee.'" required />

            <label for="vote">nombre de votant</label>
            <input name="vote" id="vote" type="number" value="'.$film->vote.'" required />

            <label for="score">score</label>
            <input name="score" id="score" type="number" value="'.$film->score.'" required />

            <input name="id" type="hidden" value="'.$film->id.'" /> 
            
            <button type="submit">Modifier le film</button>
         </form>';

        return $result;
    }

    public function display_update_result(){
        $result = '<p>Le film n\'a pas pu être modifié</p>';

        if (isset($_POST["nom"]) && isset($_POST["annee"])) {
            $film = new FilmModel($_POST);
            $this->controller->update($film);

            $result = '<p>Le film à bien été modifié</p>';
        }

        return $result;
    }

    public function display_add(){
        $result = '
        <form method="post" action="update-film-result">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" required />

            <label for="annee">annee</label>
            <input name="annee" id="annee" type="number" required />

            <label for="vote">nombre de votant</label>
            <input name="vote" id="vote" type="number" required />

            <label for="score">score</label>
            <input name="score" id="score" type="number" required />

            <button type="submit">Ajouter le film</button>
         </form>';

        return $result;
    }

    public function display_add_result() {
        $result = '<p>Le film n\'a pas pu être ajouté</p>';

        if (isset($_POST["nom"]) && isset($_POST["prenom"])) {
            $film = new FilmModel($_POST);
            $this->controller->add($film);

            $result = '<p>Le film a bien été ajouté</p>';
        }

        return $result;
    }

    public function display_delete() {
        $result = '<p>Le film n\'a pas pu être supprimé</p>';

        if (isset($_GET["id"])) {
            $film = $this->controller->get($_GET["id"]);
            $this->controller->delete($film);

            $result = '<p>Le film a bien été supprimé</p>';
        }

        return $result;
    }

    public function display_vote() {
        $result = '<p>Votre vote n\'a pas fonctionné</p>';

        if (isset($_GET["id"])) {
            $film = $this->controller->get($_GET["id"]);
            $film->setScore($film->score + 1);
            $film->setVote();
            $this->controller->update($film);

            $result = '<p>Votre vote a bien été pris en compte</p>';
        }

        return $result;
    }

    public function display_all($films){
        $result = '<table>
        <thead>
            <tr>
                <th colspan="4">Liste des films</th>
            </tr>
        </thead>
        ';

        foreach($films as $item){
            $result = $result.'<tr>';
            $result = $result.'<td>'.$item->nom.'</td>'.'<td>'.$item->annee.'</td>'.'<td>'.$item->vote.'</td>'.'<td>'.$item->score.'</td>';
            $result = $result.'<td><a href="vote-film?id='.$item->id.'">Voter</a></td>';
            $result = $result.'<td><a href="update-film?id='.$item->id.'">Modifier</a></td>';
            
            $result = $result.'</tr>';
        }

        $result = $result.'</table>';

        return $result;
    }
}

?>