<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersHasLivre extends Model
{
    public function livre() {
        return $this->belongsTo('App\Livre');
    }
}
