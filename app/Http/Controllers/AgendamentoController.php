<?php

namespace App\Http\Controllers;

use App\Models\VagaAgenda;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    // Lista todas as vagas (livres e reservadas) na Dashboard
    public function index()
    {
        $vagas = VagaAgenda::orderBy('data', 'asc')->orderBy('hora', 'asc')->get();
        return view('agenda.index', compact('vagas'));
    }

    // O Administrador abrindo um horário disponível para os clientes
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'hora' => 'required',
        ]);

        VagaAgenda::create([
            'data' => $request->data,
            'hora' => $request->hora,
            'status' => 'disponivel', // Nasce livre para o público
        ]);

        return redirect()->back()->with('sucesso', 'Horário de atendimento aberto com sucesso!');
    }

    // Ação opcional para o ADM confirmar ou cancelar uma pré-reserva
    public function alterarStatus(Request $request, $id)
    {
        $vaga = VagaAgenda::findOrFail($id);
        $vaga->status = $request->status; // 'confirmado' ou 'recusado' (volta a ficar disponivel)
        
        if ($request->status == 'disponivel') {
            $vaga->cliente_nome = null;
            $vaga->cliente_whatsapp = null;
            $vaga->observacoes = null;
        }
        
        $vaga->save();
        return redirect()->back()->with('sucesso', 'Status do agendamento atualizado!');
    }
}
