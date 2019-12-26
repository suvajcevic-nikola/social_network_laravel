<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  //u my sql je users, u laravelu user
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function following()
    {
        // niz korisnika koje korisnik prati
        return $this->belongsToMany(User::class, 'follow', 'user_id', 'friend_id'); // 'App/User', 'follow', 'user_id', 'friend_id'
    }

    public function followers()
    {
        // Niz objekta koji prate datog korinsika
        return $this->belongsToMany(User::class, 'follow', 'friend_id', 'user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
