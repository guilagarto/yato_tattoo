<?php

namespace App\Http\Controllers;

use App\Models\VagaAgenda;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    // Lista todas as vagas na Dashboard (Interno)
    public function index()
    {
        $vagas = VagaAgenda::orderBy('data', 'asc')->orderBy('hora', 'asc')->get();
        return view('agenda.index', compact('vagas'));
    }

    // O Administrador abrindo um horário disponível vazio (Interno)
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'hora' => 'required',
        ]);

        VagaAgenda::create([
            'data' => $request->data,
            'hora' => $request->hora,
            'status' => 'disponivel',
        ]);

        return redirect()->back()->with('sucesso', 'Horário de atendimento aberto com sucesso!');
    }

    // O CLIENTE fazendo o pré-agendamento pelo site público (NOVO)
    public function storePublico(Request $request)
    {
        $request->validate([
            'vaga_id' => 'required|exists:vaga_agendas,id',
            'cliente_name' => 'required|max:255',
            'cliente_whatsapp' => 'required|max:20',
            'observacoes' => 'nullable',
        ]);

        // Encontra a vaga exata que o cliente selecionou
        $vaga = VagaAgenda::findOrFail($request->vaga_id);

        // Segurança extra: Verifica se a vaga ainda está disponível
        if ($vaga->status !== 'disponivel') {
            return redirect()->back()->with('erro', 'Desculpe, este horário acabou de ser reservado por outra pessoa.');
        }

        // Atualiza a vaga com os dados capturados do formulário
        $vaga->update([
            'cliente_nome' => $request->cliente_name,
            'cliente_whatsapp' => $request->cliente_whatsapp,
            'observacoes' => $request->observacoes,
            'status' => 'reservado', // Muda o status para Pré-Reserva na Dashboard
        ]);

        return redirect()->back()->with('sucesso', 'Solicitação de agendamento enviada! Aguarde o contato do tatuador para confirmação.');
    }

    // O Administrador confirmando ou recusando a Pré-Reserva (Interno)
    public function alterarStatus(Request $request, $id)
    {
        $vaga = VagaAgenda::findOrFail($id);
        $vaga->status = $request->status;
        
        // Se for recusado, limpa os dados do cliente e a vaga volta a ficar livre no site
        if ($request->status == 'disponivel') {
            $vaga->cliente_nome = null;
            $vaga->cliente_whatsapp = null;
            $vaga->observacoes = null;
        }
        
        $vaga->save();
        return redirect()->back()->with('sucesso', 'Status do agendamento atualizado!');
    }
}
