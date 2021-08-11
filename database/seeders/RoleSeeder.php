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
        Permission::create(['name'=>'admin.home'])->syncRoles([$role1, $role2]);

        //Permisos para categorias
        Permission::create(['name'=>'admin.categories.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.categories.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.categories.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.categories.destroy'])->syncRoles([$role1, $role2]);

        //Permisos para tags
        Permission::create(['name'=>'admin.tags.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.tags.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.tags.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.tags.destroy'])->syncRoles([$role1, $role2]);

        //Permisos para posts
        Permission::create(['name'=>'admin.posts.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.destroy'])->syncRoles([$role1, $role2]);

        //asignar roles a los permisos

        /* $role1->permissions()->attach([1, 2, 3]); */


    }
}
