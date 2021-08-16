<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\Components\Widget\Card;
use App\Http\Requests\PostRequest;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.posts.index');
    }


    public function create()
    {
        //el metodo pluck sire para generar un array con el valor que se le asigne
        $categories=Category::pluck('name', 'id');
        $tags=Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }


    public function store(PostRequest $request)
    {
        /* return Storage::put('posts', $request->file('file')); */

        $post = Post::create($request->all());

        if($request->file('file')){
            $url= Storage::put('posts', $request->file('file'));

            $post->image()->create([
                'url'=> $url
            ]);
        }

        //rellenamos la tabla intermedia post_tag con lo que se ha sellecionado en nel formulario
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('info', 'El post se creó con éxito');;
    }


    public function edit(Post $post)
    {
        //policy
        $this->authorize('author', $post);

        $categories=Category::pluck('name', 'id');
        $tags=Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }


    public function update(PostRequest $request, Post $post)
    {

        //policy
        $this->authorize('author', $post);

        $post->update($request->all());

        //preguntamos si se esta mandando una imagen desde el formulario
        if($request->file('file')){
            //mandamos la imagen a nuestro servidor
            $url=Storage::put('posts', $request->file('file'));

            //preguntamos si el post contaba ya con una imagen
            if($post->image){
                //borramos la imagen que tenia y agregamos la imagen que se desea actualizar
                Storage::delete($post->image->url);
                //actualizamos la imagen nueva
                $post->image->update([
                    'url'=>$url
                ]);
            //caso contrario de no tener una imagen, se crea una nueva imagen
            }else{
                $post->image()->create([
                    'url'=>$url
                ]);
            }
        }

        //rellenamos la tabla intermedia post_tag con lo que se ha sellecionado en nel formulario
       /*  if($request->tags){
            $post->tags()->attach($request->tags);
        } */

        //Si hacemos el metodo attach al momento de actualizar se va a actualizar la etiqueta, sino
        //agregara mas etiquetas de las que tenia. Con el metodo sync se correige esto, solo se va a sincronizar

        if($request->tags)
            $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.index', $post)->with('info', 'El post se actualizó con éxito');
    }


    public function destroy(Post $post)
    {

        //policy
        $this->authorize('author', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('info2', 'El post se eliminó con éxito');
    }
}
