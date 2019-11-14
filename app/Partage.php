<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partage extends Model
{

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function usersHasLivres() {
        return $this->belongsTo('App\UsersHasLivre');
    }
}
