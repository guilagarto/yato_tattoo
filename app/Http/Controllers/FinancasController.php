<?php

namespace App\Http\Controllers;

use App\Models\FinancasTattoo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancasController extends Controller
{
    public function index(Request $request)
    {
        // Pega o mês e o ano atuais, ou os que o usuário escolheu no filtro da tela
        $mes = $request->get('mes', Carbon::now()->month);
        $ano = $request->get('ano', Carbon::now()->year);

        // Coleta os lançamentos baseados no filtro de data selecionado
        $movimentacoes = FinancasTattoo::whereMonth('data_movimentacao', $mes)
                            ->whereYear('data_movimentacao', $ano)
                            ->orderBy('data_movimentacao', 'desc')
                            ->get();

        // Faz os cálculos matemáticos de somatório usando coleções do Laravel
        $totalReceitas = $movimentacoes->where('tipo', 'receita')->sum('valor');
        $totalCustos = $movimentacoes->where('tipo', 'custo')->sum('valor');
        $lucroLiquido = $totalReceitas - $totalCustos;

        // Conta quantos trabalhos/movimentações foram realizados no período
        $trabalhosRealizados = $movimentacoes->where('tipo', 'receita')->count();

        return view('financas.index', compact(
            'movimentacoes', 'totalReceitas', 'totalCustos', 
            'lucroLiquido', 'trabalhosRealizados', 'mes', 'ano'
        ));
    }

    // Salva um novo lançamento (Receita ou Custo) enviado pelo formulário
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|max:255',
            'tipo' => 'required|in:receita,custo',
            'valor' => 'required|numeric|min:0.01',
            'data_movimentacao' => 'required|date',
        ]);

        FinancasTattoo::create($request->all());

        return redirect()->back()->with('sucesso', 'Lançamento financeiro registrado com sucesso!');
    }

    // Remove um lançamento em caso de erro de digitação
    public function destroy($id)
    {
        $lancamento = FinancasTattoo::findOrFail($id);
        $lancamento->delete();
        return redirect()->back()->with('sucesso', 'Lançamento financeiro removido.');
    }
}
