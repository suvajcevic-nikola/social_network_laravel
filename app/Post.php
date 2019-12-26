<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts"; // ovo se navodi ukoliko je ime modela razlicito od imena tabele u bazi
    protected $id = "id"; // ukoliko primarni kljuc nije kolona id

    public $timestamps = true; // kolone created_at i updated_ar se automatski popunjavaju prilikom kreiranja novog reda

    public function user()
    {
        return $this->belongsTo(User::class); // ili  'App/User'
    }

}
