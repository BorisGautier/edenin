<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    public function livres($ages) {
        $ids = explode(",", $ages);
        $result = array();
        foreach ($ids as $id){
            $listes = LivresHasAge::where('age_id', $id)->get();
            foreach ($listes as $element){
                array_push($result, Livre::find($element->livre_id));
            }
        }
        return $result;
    }
}
