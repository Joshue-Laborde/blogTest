<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){

        //verificamos si por la url pasamos la informacion de la pagina
        if(request()->page){

            $key = 'posts' . request()->page;
        }else{
            $key = 'posts';
        }


        //comprobaremos si tenemos almacenados en cache los posts
        if (Cache::has($key)) {
            //en caso de tener almacenado algo en la variable post, se va a recuperar y se almacena en la variable post
            //$posts = Cache::get('posts');
            $posts = Cache::get($key);
        } else {
             //recuper los datos de la bd. Se hace la consulta
            $posts= Post::where('status', 2)->latest('id')->paginate(8); /*->get() */
            //Se almacena en caché
            Cache::put($key, $posts);
        }


        return view('posts.index', compact('posts'));
    }

    public function show( Post $post){

        //policy
        $this->authorize('published', $post);

        //buscar la similitud de la categoria del post en la base de datos con la categoria del post enviada por parametro
        $similares= Post::where('category_id', $post->category_id)
                                ->where('status', 2)
                                ->where('id', '!=', $post->id)
                                ->latest('id')
                                //toma 4 post relacionados
                                ->take(4)
                                ->get();

        return view('posts.show', compact('post', 'similares'));
    }


    public function category( Category $category){
        $posts= Post::where('category_id', $category->id)
                        ->where('status', 2)
                        ->latest('id')
                        ->paginate(6);

        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag){

        $posts= $tag->posts()->where('status', 2)->latest('id')->paginate(6);

        return view('posts.tag', compact('posts', 'tag'));
    }
}
