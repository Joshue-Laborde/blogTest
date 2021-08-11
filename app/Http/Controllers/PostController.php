<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        //recuper los datos de la bd
        $posts= Post::where('status', 2)->latest('id')->paginate(8); /*->get() */

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
