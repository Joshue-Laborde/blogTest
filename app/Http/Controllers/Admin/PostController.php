<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\Components\Widget\Card;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //el metodo pluck sire para generar un array con el valor que se le asigne
        $categories=Category::pluck('name', 'id');
        $tags=Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=Category::pluck('name', 'id');
        $tags=Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
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
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('info', 'El post se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
