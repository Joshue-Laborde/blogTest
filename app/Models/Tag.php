<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    use HasFactory;

    protected $fillable=['name', 'slug', 'color'];

    //Este metodo sirve para que en la url no se muestre el id, sino el slug. Sirve para posisionar la pagina
    public function getRouteKeyName()
    {
        return "slug";
    }

    //relacion muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
