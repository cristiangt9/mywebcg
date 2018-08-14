<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\User;
use App\Role;
use App\Tag;
use App\Note;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('role_user')->truncate();
        Tag::truncate();
        DB::table('taggables')->truncate();
        Note::truncate();

            $role1 = Role::create([
            'name' => "admin",
            'display_name' => "Administrador del sitio",
            'description' => 'Tiene todos los permisos'
            ]);

            $role2 = Role::create([
            'name' => "mod",
            'display_name' => "Moderador de comentarios",
            'description' => 'Tiene los permisos para moderar'
            ]);

            $role3 = Role::create([
            'name' => "comen",
            'display_name' => "Generador de comentarios",
            'description' => 'Tiene los permisos para comentar'
            ]);

            $tag1 = Tag::create([
            'name' => "normal"
            ]);

            $tag2 = Tag::create([
            'name' => "importante"
            ]);

            $tag3 = Tag::create([
            'name' => "muy importante"
            ]);

        for ($i=1; $i<2; $i++) { 
            $user[$i] = User::create([
            'name' => "Usuario{$i}",
            'email' => "usuario{$i}@gmail.com",
            'password' => '123456',
            'created_at' => Carbon::now()->subDays(11)->addDays($i)
            ]);

            $user[$i]->roles()->save($role1);
            $user[$i]->tags()->save($tag3);
            $user[$i]->note()->create([
            'body' => "nota usuario{$i}"
            ]);
        }   

        for ($i=2; $i<6; $i++) { 
            $user[$i] = User::create([
            'name' => "Usuario {$i}",
            'email' => "usuario{$i}@gmail.com",
            'password' => '123456',
            'created_at' => Carbon::now()->subDays(11)->addDays($i)
            ]);

            $user[$i]->roles()->save($role2);
            $user[$i]->tags()->save($tag2);
            $user[$i]->note()->create([
            'body' => "nota usuario{$i}"
            ]);
        }
        for ($i=6; $i<15; $i++) { 
            $user[$i] = User::create([
            'name' => "Usuario {$i}",
            'email' => "usuario{$i}@gmail.com",
            'password' => '123456',
            'created_at' => Carbon::now()->subDays(11)->addDays($i)
            ]);

            $user[$i]->roles()->save($role3);
            $user[$i]->tags()->save($tag1);
            $user[$i]->note()->create([
            'body' => "nota usuario{$i}"
            ]);
        }
    }
}