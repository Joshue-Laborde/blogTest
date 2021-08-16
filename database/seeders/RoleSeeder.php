<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creamos los roles
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Blogger']);

        //creamos permisos
        Permission::create(['name'=>'admin.home',
                            'description'=> 'ver el dashboard'])->syncRoles([$role1, $role2]);

        //Permisos usuario
        Permission::create(['name'=>'admin.users.index',
                            'description'=> 'ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=> 'Asignar un rol'])->syncRoles([$role1]);

         //Permisos para roles
        Permission::create(['name'=>'admin.roles.index',
                            'description'=> 'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=> 'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=> 'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.destroy',
                            'description'=> 'Eliminar roles'])->syncRoles([$role1]);


        //Permisos para categorias
        Permission::create(['name'=>'admin.categories.index',
                            'description'=> 'Ver listado de categroias'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.categories.create',
                            'description'=> 'Crear categorias'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.categories.edit',
                            'description'=> 'Editar categorias'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.categories.destroy',
                            'description'=> 'Eliminar categorias'])->syncRoles([$role1]);

        //Permisos para tags
        Permission::create(['name'=>'admin.tags.index',
                            'description'=> 'Ver listado de etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.tags.create',
                            'description'=> 'Crear etiquetas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tags.edit',
                            'description'=> 'Editar etiquetas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tags.destroy',
                            'description'=> 'Eliminar etiquetas'])->syncRoles([$role1]);

        //Permisos para posts
        Permission::create(['name'=>'admin.posts.index',
                            'description'=> 'Ver listado de posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.create',
                            'description'=> 'Crear posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.edit',
                            'description'=> 'Editar posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.destroy',
                            'description'=> 'Eliminar posts'])->syncRoles([$role1, $role2]);

        //asignar roles a los permisos

        /* $role1->permissions()->attach([1, 2, 3]); */


    }
}
