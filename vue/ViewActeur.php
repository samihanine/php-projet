<?php
class ViewActeur {

    /**
     * affiche le formulaire de modification + les informations liées à cet acteur
     * @param films<FilmModel>
     * @param acteur
     * @param user
     * @return string
     * @access public
     */
    public function display_update($films, $acteur, $user){

        if($acteur){
            $input_class = "user-input";
            $disabled = "disabled";
  
            if($user && $user->privilege() > 0){
                $input_class = "admin-input";
                $disabled = "";
            }

            $result = '<main>
                <form class='. $input_class .' method="post" action="">
                <label for="nom">nom</label>
                <input '. $disabled .' name="nom" id="nom" type="text" value="'.$acteur->nom().'" required />

                <label for="prenom">prénom</label>
                <input '. $disabled .' name="prenom" id="annee" type="texte" value="'.$acteur->prenom().'" required />

                <input '. $disabled .' name="id" type="hidden" value="'.$acteur->id().'" />';
                
                
            if ($user && $user->privilege() > 0){
                $result = $result . '<button type="submit">Modifier</button>';
            }
            $result = $result . '</form>';

            if($films){
                $result = $result . $this->display_films_acteur($films, $acteur, $user);
            }

            $result = $result.'</main>';
            return $result;

        }
    }

    /**
     * affiche les films auquels un acteur a participé
     * @param films<FilmModel>
     * @param acteur
     * @param user
     * @return string
     * @access public
     */
    public function display_films_acteur($films, $acteur, $user){
        $result = '<table>
        <thead>
            <tr>
                <th colspan="3">Liste des Films</th>
            </tr>
        </thead>';

        foreach($films as $film){
            $result = $result . "<tr>";
            $result = $result . "<td>" . $film->nom();"</td>";
            $result = $result . "<td>" . $film->annee();"</td>";
            if($user && $user->privilege() > 0){
                $result = $result . '<td><a href="remove-actor?idfilm='. $film->id() .'&idacteur='. $acteur->id() .'&redirect=acteur">Retirer</a></td>';
            }
            $result = $result . "</tr>";
        }

        $result = $result . "</table>";

        return $result;
    }

    /**
     * affiche le formulaire pour ajouter un acteur à un film
     * @param acteurs<ActeurModel>
     * @param idFilm
     * @return string
     * @access public
     */
    public function display_add_actor($acteurs, $idfilm){
        $result = '';
        
        if($acteurs){
            
            $result = '<form method="get" action="add-actor?">
                <input type="text" name="idfilm" value="'.$idfilm.'" required hidden/>

                <select name="newactor" id="actor-select">';

                foreach($acteurs as $acteur){
                    $result = $result . '<option value="'.$acteur->id().'">'.$acteur->prenom().' '.$acteur->nom().'</option>';
                }

            $result = $result . '</select>
                <button type="submit">Ajouter</button>
                </form>';

                $result = $result.'<p>(ne peut être ajouter que les acteurs qui ne jouent pas déjà dans le film choisis)</p>';
            }else{
                $result = "<p>Il n'y a pas de nouveau acteur à ajouter.</p>";
            }

        return $result;
    }

    /**
     * affiche la page de résulat suite à l'ajout d'un acteur à un film
     * @param idfilm
     * @return string
     * @access public
     */
    public function display_add_actor_result($idfilm){
        $result = '<p>Nouvel acteur ajouté au film !</p>
            <a href="infos-film?id='. $idfilm .'">Retourner à la page du film</a>';
        return $result;
    }

    /**
     * affiche le formulaire de création d'un acteur
     * @param void
     * @return string
     * @access public
     */
    public function display_create(){
        $result = '<main>
            <form method="post" class="admin-input" action="create-acteur">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" required />

            <label for="prenom">prénom</label>
            <input id="prenom" name="prenom" type="text" required />
            
            <button type="submit">Ajouter l\'acteur</button>
         </form>';

        return $result;
    }

    /**
     * affiche le formulaire de création d'un acteur
     * @param void
     * @return string
     * @access public
     */
    public function display_create_result()
    {
        $result = "<p>Nouvel acteur ajouté !</p>";

        return $result;
    }

    /**
     * affiche l'ensemble des acteurs
     * @param acteur<ActeurModel>
     * @return string
     * @access public
     */
    public function display_all($acteur, $user){
        $result = '<table>
        <thead>
            <tr>
                <th colspan="4">Liste des acteur</th>
            </tr>
        </thead>
        ';
        
        foreach($acteur as $item){
            $result = $result.'<tr>';
            $result = $result.'<td class="info"><a href="infos-acteur?id='.$item->id().'">Voir plus</a></td>';
            $result = $result.'<td>'.$item->nom().'</td>'.'<td>'.$item->prenom().'</td>';

            if ($user) {
                if ($user->privilege() > 0) {
                    $result = $result.'<td class="delete"><a href="delete-acteur?id='.$item->id().'">Supprimer</a></td>';
                }
            }

            $result = $result.'</tr>';
        }

        $result = $result.'</table>';

        return $result;
    }
}

?>