<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // Exibe a página de gerenciamento na Dashboard
    public function index()
    {
        $trabalhos = Portfolio::latest()->get();
        return view('portfolio.index', compact('trabalhos'));
    }

    // Salva a nova tatuagem enviada pelo formulário
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // max 2MB
        ]);

        // Faz o upload da foto de forma segura para a pasta storage/app/public/tattoos
        $caminhoImagem = $request->file('imagem')->store('tattoos', 'public');

        // Cria o registro no banco de dados
        Portfolio::create([
            'titulo' => $request->titulo,
            'imagem' => $caminhoImagem,
            'estilo' => $request->estilo,
            'descricao' => $request->descricao,
        ]);

        return redirect()->back()->with('sucesso', 'Trabalho adicionado ao portfólio com sucesso!');
    }

    use Illuminate\Support\Facades\Storage;

// Abre a tela de edição de uma foto específica
public function edit($id)
{
    $trabalho = Portfolio::findOrFail($id);
    return view('portfolio.edit', compact('trabalho'));
}

// Atualiza as informações ou a foto no banco
public function update(Request $request, $id)
{
    $trabalho = Portfolio::findOrFail($id);

    $request->validate([
        'titulo' => 'required|max:255',
        'imagem' => 'nullable|image|max:2048',
    ]);

    $trabalho->titulo = $request->titulo;
    $trabalho->estilo = $request->estilo;
    $trabalho->descricao = $request->descricao;

    // Se o usuário enviou uma nova foto, deleta a antiga e salva a nova
    if ($request->hasFile('imagem')) {
        Storage::disk('public')->delete($trabalho->imagem);
        $trabalho->imagem = $request->file('imagem')->store('tattoos', 'public');
    }

    $trabalho->save();

    return redirect()->route('portfolio.index')->with('sucesso', 'Trabalho atualizado com sucesso!');
}

// Exclui a foto e o registro do banco de dados definitivamente
public function destroy($id)
{
    $trabalho = Portfolio::findOrFail($id);
    
    // Deleta o arquivo de imagem da pasta storage
    Storage::disk('public')->delete($trabalho->imagem);
    
    // Deleta a linha do banco de dados
    $trabalho->delete();

    return redirect()->back()->with('sucesso', 'Trabalho removido do portfólio!');
}


}
