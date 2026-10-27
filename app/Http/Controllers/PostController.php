<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    // Endpoint optimizado con Eager Loading
    public function index(): JsonResponse
    {
        // Se utiliza with('user') para precargar la relación y evitar el N+1
        $posts = Post::with('user')
            ->where('is_published', true)
            ->get();

        $data = $posts->map(fn ($post) => [
            'id' => $post->id,
            'title' => $post->title,
            'author' => $post->user->name, // Ya no dispara consultas SQL individuales
        ]);

        return response()->json($data);
    }
}