<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentairelivre extends Model
{
    public function contenu() {
        return $this->belongsTo('App\Contenu');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
