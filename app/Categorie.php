<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function livres($idCategory) {
        $ids = explode(",", $idCategory);
        $result = array();
        foreach ($ids as $id){
            $listes = LivresHasCategorie::where('categorie_id', $id)->get();
            foreach ($listes as $element){
                array_push($result, Livre::find($element->livre_id));
            }
        }
        return $result;

    }
}
