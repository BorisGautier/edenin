<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ville', 'date_naissance', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function commentaires() {
        return $this->hasMany('App\Commentairelivre');
    }

    public function livres() {
        return $this->belongsToMany('App\Livre', 'users_has_livres');
    }

    public function partages() {
        return $this->hasMany('App\Partage')->with('user',
            'usersHasLivres', 'usersHasLivres.livre');
    }
}
