<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PostController;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Carrossel;
use App\Models\Promocao;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminConfigController;
use App\Http\Controllers\FinancasController;
/*
|--------------------------------------------------------------------------
| Rotas Públicas do Site (Acessíveis para qualquer cliente)
|--------------------------------------------------------------------------
*/

// Rota da Página Inicial (Home) - Coleta Carrossel, Promoções, Portfólio e Blog
Route::get('/', function () {
    $trabalhos = Portfolio::latest()->take(6)->get(); 
    $artigos = Post::latest()->take(3)->get(); 
    $banners = Carrossel::where('ativo', true)->latest()->get();
    $promocoes = Promocao::where('ativa', true)->latest()->get();
    
    return view('welcome', compact('trabalhos', 'artigos', 'banners', 'promocoes'));
});

// Rota dedicada para a Página de Portfólio Público com paginação
Route::get('/portfolio', function () {
    $trabalhos = Portfolio::latest()->paginate(12); 
    return view('paginas.portfolio', compact('trabalhos'));
})->name('publico.portfolio');

// Rota dedicada para a Página de Blog Público com paginação
Route::get('/blog', function () {
    $artigos = Post::latest()->paginate(6); 
    return view('paginas.blog', compact('artigos'));
})->name('publico.blog');

// Rota pública para Ler um Artigo completo usando o slug amigável
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('publico.blog.show');

// Rota dedicada para a Página de Agendamento/Reserva Pública
Route::get('/agenda', function () {
    // Coleta apenas os horários marcados como disponíveis pelo administrador
    $horariosLivres = \App\Models\VagaAgenda::where('status', 'disponivel')
                        ->orderBy('data', 'asc')
                        ->orderBy('hora', 'asc')
                        ->get();
    return view('paginas.agenda', compact('horariosLivres'));
})->name('publico.agenda');


// Rota que processa o envio do formulário de agendamento do cliente
Route::post('/agendar-visita', [AgendamentoController::class, 'store'])->name('publico.agendar');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas da Dashboard (Apenas Usuários Logados)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil do Usuário Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Painel de Gerenciamento do Portfólio (CRUD Completo)
    Route::get('/dashboard/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('/dashboard/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/dashboard/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/dashboard/portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/dashboard/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

    // Painel de Gerenciamento da Agenda Interna
    Route::get('/dashboard/agenda', [AgendamentoController::class, 'index'])->name('agenda.index');
    Route::post('/dashboard/agenda', [AgendamentoController::class, 'store'])->name('agenda.store');

    // Painel de Gerenciamento do Blog Interno
    Route::get('/dashboard/blog', [PostController::class, 'index'])->name('blog.index');
    Route::post('/dashboard/blog', [PostController::class, 'store'])->name('blog.store');
});


Route::middleware('auth')->group(function () {
    // ... suas rotas anteriores do portfolio e blog ...

    // Novas rotas de Customização e Agenda Controlada
    Route::get('/dashboard/configuracoes', [AdminConfigController::class, 'index'])->name('admin.configuracoes');
    Route::post('/dashboard/configuracoes/agenda', [AdminConfigController::class, 'abrirHorario'])->name('admin.agenda.abrir');
    Route::post('/dashboard/configuracoes/carrossel', [AdminConfigController::class, 'salvarBanner'])->name('admin.carrossel.salvar');
    Route::delete('/dashboard/configuracoes/carrossel/{id}', [AdminConfigController::class, 'deletarBanner'])->name('admin.carrossel.deletar');
});

Route::middleware('auth')->group(function () {
    // ... suas rotas anteriores ...
    
    Route::get('/dashboard/agenda', [AgendamentoController::class, 'index'])->name('agenda.index');
    Route::post('/dashboard/agenda', [AgendamentoController::class, 'store'])->name('agenda.store');
    
    // ADICIONE ESTA NOVA ROTA DO STATUS BEM AQUI:
    Route::patch('/dashboard/agenda/{id}/status', [AgendamentoController::class, 'alterarStatus'])->name('agenda.status');
});

Route::middleware('auth')->group(function () {
    // ... suas rotas anteriores de portfolio e agenda ...

    Route::get('/dashboard/blog', [PostController::class, 'index'])->name('blog.index');
    Route::post('/dashboard/blog', [PostController::class, 'store'])->name('blog.store');
    
    // ADICIONE ESTAS TRÊS LINHAS EXATAMENTE AQUI:
    Route::get('/dashboard/blog/{id}/edit', [PostController::class, 'edit'])->name('blog.edit');
    Route::put('/dashboard/blog/{id}', [PostController::class, 'update'])->name('blog.update');
    Route::delete('/dashboard/blog/{id}', [PostController::class, 'destroy'])->name('blog.destroy');
});


Route::middleware('auth')->group(function () {
    // ... suas rotas anteriores de portfolio, agenda e blog ...

    // Rotas do Painel Financeiro
    Route::get('/dashboard/financas', [FinancasController::class, 'index'])->name('financas.index');
    Route::post('/dashboard/financas', [FinancasController::class, 'store'])->name('financas.store');
    Route::delete('/dashboard/financas/{id}', [FinancasController::class, 'destroy'])->name('financas.destroy');
});

Route::middleware('auth')->group(function () {
    // ... suas rotas anteriores ...

    // Novas Rotas do Painel de Promoções:
    Route::post('/dashboard/configuracoes/promocao', [AdminConfigController::class, 'salvarPromocao'])->name('admin.promocao.salvar');
    Route::delete('/dashboard/configuracoes/promocao/{id}', [AdminConfigController::class, 'deletarPromocao'])->name('admin.promocao.deletar');
});

// Rota que processa o envio do formulário de agendamento do cliente na web
Route::post('/agendar-visita', [AgendamentoController::class, 'storePublico'])->name('publico.agendar');


// Importa as rotas nativas de autenticação (Login, Logout, etc.)
require __DIR__.'/auth.php';
