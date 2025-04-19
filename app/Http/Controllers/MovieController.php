<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        return response()->json(['movies' => Movie::all()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'required|image|max::2048',
        ]);

        $path = $request->file('poster')->store('posters', 'public');

        $movie = Movie::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'poster' => "/storage/{$path}",
        ]);

        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie], 201);
    }
}
