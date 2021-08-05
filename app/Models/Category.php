<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //asignacion masiva, los campos que esten son los unicos que se pueden inyectar
    protected $fillable=['name','slug'];

    //Este metodo sirve para que en la url no se muestre el id, sino el slug. Sirve para posisionar la pagina
    public function getRouteKeyName()
    {
        return "slug";
    }

    //Relacion uno a muchos
     public function posts(){
        return $this->hasMany('App\Models\Post');
    }

}
