<?php
class ViewActeur {

    /**
     * affiche le formulaire de modification
     * @param films<FilmModel>
     * @param acteur
     * @param user
     * @return string
     * @access private 
     */
    public function display_update($films, $acteur, $user){

        if($acteur){
            $input_class = "user-input";
            $disabled = "disabled";
            //if($user){
                if($user && $user->privilege() > 0){
                    $input_class = "admin-input";
                    $disabled = "";
                }
           // }
            $result = '
                <form method="post" action="">
                <label for="nom">nom</label>
                <input '. $disabled .' class='. $input_class .' name="nom" id="nom" type="text" value="'.$acteur->nom().'" required />

                <label for="prenom">prénom</label>
                <input '. $disabled .' class='. $input_class .' name="prenom" id="annee" type="texte" value="'.$acteur->prenom().'" required />

                <input '. $disabled .' class='. $input_class .' name="id" type="hidden" value="'.$acteur->id().'" />';
                
                
            if ($user && $user->privilege() > 0){
                $result = $result . '<button type="submit">Modifier</button>';
            }
            $result = $result . '</form>';

            if($films){
                $result = $result . $this->display_films_acteur($films, $acteur, $user);
            }

            return $result;

        }
    }

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

    public function display_add_actor($acteurs, $idfilm){
        $result = '<form method="get" action="add-actor?">
            <input type="text" name="idfilm" value="'.$idfilm.'" required hidden/>

            <select name="newactor" id="actor-select">';

            foreach($acteurs as $acteur){
                $result = $result . '<option value="'.$acteur->id().'">'.$acteur->prenom().' '.$acteur->nom().'</option>';
            }

        $result = $result . '</select>
            <button type="submit">Ajouter</button>
            </form>';

        return $result;
    }

    public function display_add_actor_result($idfilm){
        $result = '<p>Nouvel acteur ajouté au film !</p>
            <a href="infos-film?id='. $idfilm .'">Retourner à la page du film</a>';
        return $result;
    }

    public function display_update_result(){
        $result = '<p>L\'acteur à bien été modifié</p>';
       

        return $result;
    }

    public function display_create(){
        $result = '
            <form method="post" action="create-acteur">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" required />

            <label for="prenom">prénom</label>
            <input id="prenom" name="prenom" type="text" required />
            
            <button type="submit">Ajouter l\'acteur</button>
         </form>';

        return $result;
    }

    public function display_create_result() {
        $result = "<p>Nouvel acteur ajouté !</p><p>Vous pouvez dès maintenant le relier à un film</p>";

        return $result;
    }

    public function display_delete() {
        $result = '<p>L\'acteur n\'a pas pu être supprimé</p>';

        if (isset($_GET["id"])) {
            $acteur = $this->controller->get($_GET["id"]);
            $this->controller->delete($acteur);

            $result = '<p>L\'acteur à bien été supprimé</p>';
        }

        return $result;
    }

    public function display_all($acteur){
        $result = '<table>
        <thead>
            <tr>
                <th colspan="4">Liste des acteur</th>
            </tr>
        </thead>
        ';
        
        foreach($acteur as $item){
            $result = $result.'<tr>';
            $result = $result.'<td>'.$item->nom.'</td>'.'<td>'.$item->prenom.'</td>';

            $result = $result.'<td><a href="infos-acteur?id='.$item->id.'">Infos</a></td>';
            
            $result = $result.'<td><a href="delete-acteur?id='.$item->id.'">Supprimer</a></td>';

            $result = $result.'</tr>';
        }

        $result = $result.'</table>';

        return $result;
    }
}

?>