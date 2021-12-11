<?php
class ViewActeur {

    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function display_update(){
        $acteur = $this->controller->get($_GET["id"]);

        $result = '
            <form method="post" action="update-acteur-result">
            <label for="nom">nom</label>
            <input name="nom" id="nom" type="text" value="'.$acteur->nom.'" required />

            <label for="prenom">prénom</label>
            <input name="prenom" id="prenom" type="text" value="'.$acteur->prenom.'" required />

            <input name="id" type="hidden" value="'.$acteur->id.'" /> 
            
            <button type="submit">Modifier l\'acteur</button>
         </form>';

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

    public function display_all(){
        $list = $this->controller->getList();
        $result = '<table>
        <thead>
            <tr>
                <th colspan="4">Liste des acteurs</th>
            </tr>
        </thead>
        ';
        
        foreach($list as $item){
            $result = $result.'<tr>';
            $result = $result.'<td>'.$item->nom.'</td>'.'<td>'.$item->prenom.'</td>';

            $result = $result.'<td><a href="update-acteur?id='.$item->id.'">Modifier</a></td>';
            
            $result = $result.'<td><a href="delete-acteur?id='.$item->id.'">Supprimer</a></td>';

            $result = $result.'</tr>';
        }

        $result = $result.'</table>';

        return $result;
    }
}

?>