<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
        //return $this->belongsTo(User::class);
    }


    public function category(){
        return $this->belongsTo('App\Models\Category');
    }


    //Relación muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //relacion uno a uno polimorfica
    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }
}
