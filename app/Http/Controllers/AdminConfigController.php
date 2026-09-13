<?php

namespace App\Http\Controllers;

use App\Models\VagaAgenda;
use App\Models\Carrossel;
use App\Models\Promocao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminConfigController extends Controller
{
    // Tela onde o ADM cria horarios, sobe banners do carrossel e cupons de desconto
    public function index()
    {
        $vagas = VagaAgenda::orderBy('data', 'asc')->orderBy('hora', 'asc')->get();
        $banners = Carrossel::latest()->get();
        $promocoes = Promocao::latest()->get();
        
        return view('dashboard.configuracoes', compact('vagas', 'banners', 'promocoes'));
    }

    // ADM abrindo um novo horario na agenda
    public function abrirHorario(Request $request)
    {
        $request->validate([
            'data' => 'required|date', 
            'hora' => 'required'
        ]);
        
        VagaAgenda::create([
            'data' => $request->data,
            'hora' => $request->hora,
            'status' => 'disponivel', // Nasce livre para o público agendar
        ]);
        
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
            'link' => $request->link,
            'ativo' => true
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

    // ADM lancando uma nova promocao ou cupom na Home
    public function salvarPromocao(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'cupom' => 'nullable|max:20'
        ]);

        Promocao::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'cupom' => $request->cupom ? strtoupper($request->cupom) : null, // Garante o cupom em caixa alta
            'ativa' => true
        ]);

        return redirect()->back()->with('sucesso', 'Nova promoção lançada com sucesso no site!');
    }

    // ADM removendo uma promocao antiga do painel e do site
    public function deletarPromocao($id)
    {
        $promo = Promocao::findOrFail($id);
        $promo->delete();
        
        return redirect()->back()->with('sucesso', 'Promoção removida do painel!');
    }
}
