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
}
