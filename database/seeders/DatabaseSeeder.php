<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creamos una carpeta con el nombre post
        Storage::makeDirectory('posts');

        //\App\Models\User::factory(10)->create(); creamos un seeder aparte para configurar que en los usuarios este el nuestro

        //llamamos a los seeder creado
        $this->call(UserSeeder::class);

        //No hace falta crear un seede aparte, ya que no imparta su contenido. Se llena con cualquier dato
        Category::factory(4)->create();
        Tag::factory(8)->create();

        //Post::factory(100)->create(); Creamos un seeder aparte para configurar que cada post se suba con una imagen
        $this->call(PostSeeder::class);
    }
}
