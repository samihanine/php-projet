<?php
class ViewActeur {

    private $controller;

    public function __construct() {
        
    }

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
                <form method="post" action="update-acteur-result">
                <label for="nom">nom</label>
                <input '. $disabled .' class='. $input_class .' name="nom" id="nom" type="text" value="'.$acteur->nom().'" required />

                <label for="prenom">prénom</label>
                <input '. $disabled .' class='. $input_class .' name="annee" id="annee" type="texte" value="'.$acteur->prenom().'" required />

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


    public function display_update_result(){
        $result = '<p>L\'acteur à bien été modifié</p>';
       

        return $result;
    }

    public function display_add(){
        $result = '
            <form method="post" action="add-acteur-result">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" required />

            <label for="prenom">prénom</label>
            <input id="prenom" name="prenom" type="text" required />
            
            <button type="submit">Ajouter l\'acteur</button>
         </form>';

        return $result;
    }

    public function display_add_result() {
        $result = '<p>L\'acteur n\'a pas pu être ajouté</p>';

        if (isset($_POST["nom"]) && isset($_POST["prenom"])) {
            $acteur = new ActeurModel($_POST);
            $this->controller->add($acteur);

            $result = '<p>L\'acteur à bien été ajouté</p>';
        }

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

            $result = $result.'<td><a href="infos-acteur?id='.$item->id.'">Modifier</a></td>';
            
            $result = $result.'<td><a href="delete-acteur?id='.$item->id.'">Supprimer</a></td>';

            $result = $result.'</tr>';
        }

        $result = $result.'</table>';

        return $result;
    }
}

?>