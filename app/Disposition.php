<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    public function contenus() {
        return $this->hasMany('App\Contenu');
    }
}
