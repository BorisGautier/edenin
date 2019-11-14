<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    public function livre() {
        return $this->belongsTo('App\Livre');
    }

    public function disposition() {
        return $this->belongsTo('App\Disposition');
    }

    public function commentaires() {
        return $this->hasMany('App\Commentaire')->with('user')->get();
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    public function audios() {
        return $this->hasMany('App\Audio');
    }

    public function textes() {
        return $this->hasMany('App\Texte');
    }

    public function langue() {
        return $this->belongsTo('App\Langue');
    }
}
