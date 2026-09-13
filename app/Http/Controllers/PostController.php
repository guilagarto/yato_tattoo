<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('blog.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
            'capa' => 'nullable|image|max:2048',
        ]);

        $caminhoCapa = null;
        if ($request->hasFile('capa')) {
            $caminhoCapa = $request->file('capa')->store('blog', 'public');
        }

        Post::create([
            'titulo' => $request->titulo,
            'slug' => Str::slug($request->titulo), // Transforma "Cuidados Pós Tattoo" em "cuidados-pos-tattoo"
            'conteudo' => $request->conteudo,
            'capa' => $caminhoCapa,
        ]);

        return redirect()->back()->with('sucesso', 'Artigo publicado no blog com sucesso!');
    }
        // Exibe um artigo completo no site público
    public function show($slug)
    {
        // Busca o post pelo slug ou retorna erro 404 se não existir
        $artigo = Post::where('slug', $slug)->firstOrFail();
        
        return view('blog.show', compact('artigo'));
    }

}
