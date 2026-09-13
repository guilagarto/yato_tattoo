<?php

namespace App\Http\Controllers;

use App\Models\VagaAgenda;
use App\Models\Carrossel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminConfigController extends Controller
{
    // Tela onde o ADM cria horários e sobe banners do carrossel
    public function index()
    {
        $vagas = VagaAgenda::orderBy('data', 'asc')->orderBy('hora', 'asc')->get();
        $banners = Carrossel::latest()->get();
        return view('dashboard.configuracoes', compact('vagas', 'banners'));
    }

    // ADM abrindo um novo horário na agenda
    public function abrirHorario(Request $request)
    {
        $request->validate(['data' => 'required|date', 'hora' => 'required']);
        VagaAgenda::create($request->all());
        return redirect()->back()->with('sucesso', 'Horário de atendimento aberto com sucesso!');
    }

    // ADM subindo foto para o Carrossel do topo do site
    public function salvarBanner(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|max:3072',
            'titulo' => 'nullable|max:255',
            'link' => 'nullable'
        ]);

        $caminho = $request->file('imagem')->store('carrossel', 'public');

        Carrossel::create([
            'imagem' => $caminho,
            'titulo' => $request->titulo,
            'link' => $request->link
        ]);

        return redirect()->back()->with('sucesso', 'Banner adicionado ao Carrossel da Home!');
    }

    // ADM deletando um banner do carrossel
    public function deletarBanner($id)
    {
        $banner = Carrossel::findOrFail($id);
        Storage::disk('public')->delete($banner->imagem);
        $banner->delete();
        return redirect()->back()->with('sucesso', 'Banner removido do carrossel.');
    }
}
