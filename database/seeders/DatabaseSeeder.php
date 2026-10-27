<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear un usuario de prueba
        $user = User::create([
            'name' => 'Usuario Prueba',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Crear un post de prueba asociado al usuario
        $post = Post::create([
            'user_id' => $user->id,
            'title' => 'Mi primer Post',
            'content' => 'Este es el contenido del post de prueba.',
            'is_published' => true,
        ]);

        // 3. (Opcional) Crear un comentario de prueba en el post
        if (class_exists(\App\Models\Comment::class)) {
            Comment::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'body' => 'Este es un comentario de prueba.',
            ]);
        }
    }
}