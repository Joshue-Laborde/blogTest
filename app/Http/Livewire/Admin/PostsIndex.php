<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;


class PostsIndex extends Component
{
    use WithPagination;
    //cambiar de tailwind a bootstrap
    protected $paginationTheme= "bootstrap";
    public $search;


    //este metdodo sirve para cuando si estamos en otra opaginat, la url se resetee y este en la primera
    //se activa cuando el valor de la propiedad search cambie. Despues se resetea la informacion a la pag 1
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        //recuperamos los post del usuaro autentificado
        //auth()->user recuperamos el registro del usuario actualmente autentificado
        $posts= Post::where('user_id', auth()->user()->id)
                        ->where('name', 'LIKE', '%'. $this->search. '%')
                        ->latest('id')
                        ->paginate();



        return view('livewire.admin.posts-index', compact('posts'));
    }
}
