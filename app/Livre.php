<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    public function ages(){
        return $this->belongsToMany('App\Age', 'livres_has_ages');
    }

    public function categories() {
        return $this->belongsToMany('App\Categorie', 'livres_has_categories');
    }

    public function contenus() {
        return $this->hasMany('App\Contenu')->with('textes', 'images', 'audios');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'users_has_livres');
    }


}
