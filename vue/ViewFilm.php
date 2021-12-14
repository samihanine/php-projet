<?php
class ViewFilm {

    private $controller;

    public function __construct() {
       
    }

    public function display_update($film, $acteurs, $user){
        $img = "https://www.mezencloiremeygal.fr/wp-content/uploads/2018/10/film.png";
        $path = $film->path();
        if ($path != "") {
            $img = $_SERVER['HTTP_HOST'].'/'.basename(__DIR__).'/'.$path;
        }
        
        echo $img;
        if($film){
            $input_class = "user-input";
            $disabled = "disabled";
            //if($user){
                if($user && $user->privilege() > 0){
                    $input_class = "admin-input";
                    $disabled = "";
                }
           // }
            $result = '
                <form method="post" action="update-film-result">

                <img src="'.$img.'" alt="jacket film" />

                <label for="nom">nom</label>
                <input '. $disabled .' class='. $input_class .' name="nom" id="nom" type="text" value="'.$film->nom().'" required />

                <label for="annee">annee</label>
                <input '. $disabled .' class='. $input_class .' name="annee" id="annee" type="number" value="'.$film->annee().'" required />

                <label for="vote">nombre de votant</label>
                <input '. $disabled .' class='. $input_class .' name="vote" id="vote" type="number" value="'.$film->vote().'" required />

                <label for="score">score</label>
                <input '. $disabled .' class='. $input_class .' name="score" id="score" type="number" value="'.$film->score().'" required />

                <input '. $disabled .' class='. $input_class .' name="id" type="hidden" value="'.$film->id().'" />';
                
            if ($user && $user->privilege() > 0){
                $result = $result . '<button type="submit">Modifier le film</button>';
            }
            $result = $result . '</form>';

            if($acteurs){
                $result = $result . $this->display_acteurs_film($film, $acteurs, $user);
            }

            if($user && $user->privilege() > 0){
                $result = $result . '<a href="add-actor?idfilm='. $film->id() . '">Ajouter un acteur</a>';
            }

            return $result;

        }
    }

    public function display_acteurs_film($film, $acteurs, $user){
        $result = '<table>
        <thead>
            <tr>
                <th colspan="3">Liste des Acteurs</th>
            </tr>
        </thead>';

        foreach($acteurs as $acteur){
            $result = $result . "<tr>";
            $result = $result . "<td>" . $acteur->prenom();"</td>";
            $result = $result . "<td>" . $acteur->nom();"</td>";
            if($user && $user->privilege() > 0){
                $result = $result . '<td><a href="remove-actor?idfilm='. $film->id() .'&idacteur='. $acteur->id() .'&redirect=film">Retirer</a></td>';
            }
            $result = $result . "</tr>";
        }

        $result = $result . "</table>";

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


    public function display_create() {
        $result = '
        <form method="post" enctype="multipart/form-data" action="create-film">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" required />

            <label for="annee">annee</label>
            <input name="annee" id="annee" type="number" required />

            <label for="vote">nombre de votant</label>
            <input name="vote" id="vote" type="number" required />

            <label for="score">score</label>
            <input name="score" id="score" type="number" required />

            <label for="file">image</label>
            <input type="hidden" id="file" name="MAX_FILE_SIZE" value="1048576" />
            <input type="file" name="userfile" />


            <button type="submit">Ajouter le film</button>
        </form>';

        return $result;
    }

    public function display_create_result() {
        $result = "<p>Nouveau film ajouté !</p>";

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

    public function display_all($films, $user){
        $result = '<table>
        <thead>
            <tr>
                <th colspan="4">Liste des films</th>
            </tr>
        </thead>
        ';

        foreach($films as $item){
            $result = $result.'<tr>';
            $result = $result.'<td><a href="infos-film?id='.$item->id.'">'.$item->nom.'</td>'.'<td>'.$item->annee.'</td>'.'<td>'.$item->vote.'</td>'.'<td>'.$item->score.'</td>';
            if($user){
                $result = $result.'<td><a href="vote-film?id='.$item->id.'">Voter</a></td>';
                if($user->privilege() > 0){
                    $result = $result.'<td><a href="update-film?id='.$item->id.'">Modifier</a></td>';
                }
            }
            
            $result = $result.'</tr>';
        }

        $result = $result.'</table>';

        return $result;
    }

}

?>