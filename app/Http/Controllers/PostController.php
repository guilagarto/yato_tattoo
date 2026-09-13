<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



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


// Abre a tela com o formulário de edição do artigo
public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('blog.edit', compact('post'));
}

// Processa a atualização do artigo no banco de dados
public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $request->validate([
        'titulo' => 'required|max:255',
        'conteudo' => 'required',
        'capa' => 'nullable|image|max:2048',
    ]);

    $post->titulo = $request->titulo;
    $post->slug = Str::slug($request->titulo); // Atualiza a URL amigável se o título mudar
    $post->conteudo = $request->conteudo;

    // Se o administrador enviou uma nova foto de capa
    if ($request->hasFile('capa')) {
        // Deleta a capa antiga se ela existir no disco
        if ($post->capa) {
            Storage::disk('public')->delete($post->capa);
        }
        // Salva a nova foto na pasta 'blog'
        $post->capa = $request->file('capa')->store('blog', 'public');
    }

    $post->save();

    return redirect()->route('blog.index')->with('sucesso', 'Artigo do blog atualizado com sucesso!');
}

// Deleta o artigo e remove a foto do servidor definitivamente
public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Remove a foto física do servidor se ela existir
    if ($post->capa) {
        Storage::disk('public')->delete($post->capa);
    }

    $post->delete();

    return redirect()->back()->with('sucesso', 'Artigo removido do blog com sucesso!');
}


}
