<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index()
    {
        // Pega todos os agendamentos ordenados por data e hora mais próxima
        $agendamentos = Agendamento::orderBy('data', 'asc')->orderBy('hora', 'asc')->get();
        return view('agenda.index', compact('agendamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_nome' => 'required|max:255',
            'cliente_whatsapp' => 'required',
            'data' => 'required|date',
            'hora' => 'required',
        ]);

        Agendamento::create($request->all());

        return redirect()->back()->with('sucesso', 'Horário agendado com sucesso!');
    }
}
