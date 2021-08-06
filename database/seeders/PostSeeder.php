<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts=Post::factory(300)->create();


        //Sirve parw que cada post que se cree, se descargue una imagen
        foreach($posts as $post){
            Image::factory(1)->create([
                'imageable_id'=>$post->id,
                'Imageable_type'=> Post::class,
            ]);
            //para agregar tagas a los post y viceversa
            $post->tags()->attach([
                rand(1,4),
                rand(5,8)
            ]);
        }
    }
}
