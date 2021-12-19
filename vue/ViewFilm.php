<?php
class ViewFilm {

    /**
     * affiche le formulaire de modification + les informations liées à ce film
     * @param film
     * @param acteurs<ActeurModel>
     * @param user
     * @return string
     * @access public
     */
    public function display_update($film, $acteurs, $user)
    {
        $img = "https://cdn.pixabay.com/photo/2014/04/03/10/43/clapboard-311208_960_720.png";
        $path = $film->path();
        if ($path != "") {
            $img = './' . $path;
        }

        if (!$film) return "";

        $input_class = "user-input";
        $disabled = "disabled";

        if ($user && $user->privilege() > 0) {
            $input_class = "admin-input";
            $disabled = "";
        }
        $result = '<main>
                <div class="div-flex">
                <form method="post" class=' . $input_class . ' enctype="multipart/form-data" action="">

                <img src="' . $img . '" alt="jacket film" />

                <label for="nom">nom</label>
                <input ' . $disabled . ' name="nom" id="nom" type="text" value="' . $film->nom() . '" required />

                <label for="annee">annee</label>
                <input ' . $disabled . '  name="annee" id="annee" type="number" value="' . $film->annee() . '" required />

                <label for="vote">nombre de votant</label>
                <input ' . $disabled . ' name="vote" id="vote" type="number" value="' . $film->vote() . '" required />

                <label for="score">score</label>
                <input ' . $disabled . ' name="score" id="score" value="' . $film->score() . '" required />

                <input ' . $disabled . ' name="id" type="hidden" value="' . $film->id() . '" />

                <input '. $disabled .' name="path" type="hidden" value="'.$film->path().'" />';

        if ($user && $user->privilege() > 0) {
            $result = $result .'<label for="file">Modifier l\'image</label>
            <input type="file" name="userfile" />';
            
            $result = $result . '<button type="submit">Modifier le film</button>';
        }
        $result = $result . '</form>';

        $result = $result . "<div>";

        if ($acteurs) {
            $result = $result . $this->display_acteurs_film($film, $acteurs, $user);
        }



        if ($user && $user->privilege() > 0) {
            $result = $result . '<a class="btn" href="add-actor?idfilm=' . $film->id() . '">Ajouter un acteur</a>';
        }
        
        $result = $result.'</div></div></main>';

        return $result;
    }

    /**
     * affiche la liste des acteurs jouant dans le film donné
     * @param film
     * @param acteurs<ActeurModel>
     * @param user
     * @return string
     * @access public
     */
    public function display_acteurs_film($film, $acteurs, $user)
    {
        $result = '<table>
        <thead>
            <tr>
                <th colspan="3">Liste des Acteurs</th>
            </tr>
        </thead>';

        foreach ($acteurs as $acteur) {
            $result = $result . "<tr>";
            $result = $result . "<td>" . $acteur->prenom();
            "</td>";
            $result = $result . "<td>" . $acteur->nom();
            "</td>";
            if ($user && $user->privilege() > 0) {
                $result = $result . '<td class="delete"><a href="remove-actor?idfilm=' . $film->id() . '&idacteur=' . $acteur->id() . '&redirect=film">Retirer</a></td>';
            }
            $result = $result . "</tr>";
        }

        $result = $result . "</table>";

        return $result;
    }

    /**
     * affiche le formulaire de création d'un film
     * @param void
     * @return string
     * @access public
     */
    public function display_create()
    {
        $result = '<main>
        <form method="post" class="admin-input" enctype="multipart/form-data" action="create-film">
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
        </form>
        </main>';

        return $result;
    }

    /**
     * affiche le résultat de la création d'un film
     * @param void
     * @return string
     * @access public
     */
    public function display_create_result()
    {
        $result = "<p>Nouveau film ajouté !</p>";

        return $result;
    }

    /**
     * affiche l'ensemble des films
     * @param void
     * @return string
     * @access public
     */
    public function display_all($films, $user)
    {
        $result = '<table>
        <thead>
            <tr>
                <th colspan="8">Liste des films</th>
            </tr>
        </thead>
        ';

        foreach ($films as $item) {
            $img = "https://cdn.pixabay.com/photo/2014/04/03/10/43/clapboard-311208_960_720.png";
            $path = $item->path();
            if ($path != "") {
                $img = './' . $path;
            }

            $result = $result . '<tr>';
            $result = $result . '<td class="info"><a href="infos-film?id=' . $item->id() . '">Voir plus</a></td>';
            $result = $result . '<td class="img-container"><img height="50" src="' . $img . '" /></td>'.'<td><a href="infos-film?id=' . $item->id() . '">' . $item->nom() . '</td>' .'<td>' . $item->annee() . '</td>' . '<td>' . $item->vote() . '</td>' . '<td>' . $item->score() . '</td>';
            if ($user) {
                $result = $result . '<td class="vote"><a href="vote-film?id=' . $item->id() . '">Voter</a></td>';
                if ($user->privilege() > 0) {
                    $result = $result . '<td class="delete"><a href="delete-film?id=' . $item->id(). '">Supprimer</a></td>';
                }
            }

            $result = $result . '</tr>';
        }

        $result = $result . '</table>';

        return $result;
    }
}
