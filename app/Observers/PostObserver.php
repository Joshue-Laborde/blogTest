<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class PostObserver
{

    //created se activa despues de haber sido creado (post)
    //creating se activa justo antes de que se cree el post

    public function creating(Post $post)
    {
       //se aplica este metodo para que no entre conflicto con los seeders
       if(! App::runningInConsole())
            //cada vez que se crea un nuevo post, se le asigne el campo user_id al id del usuario autentificado.
            $post->user_id = auth()->user()->id;
    }


    //deleted se activa despues de haber sido eliminado (post)
    //deleting se activa justo antes de que se elimine el post

    // ------Registrar nuestro observer----

    //ir a providers-eventService..-importar el modelo post y su observer
    //de ahi registrar el observador en el metodo boot
    public function deleting(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image->url);
        }

    }


}
