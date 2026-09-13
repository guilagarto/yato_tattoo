<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Models\Portfolio;
use App\Models\Post;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    // Pega as últimas 6 fotos do portfólio
    $trabalhos = Portfolio::latest()->take(6)->get(); 
    
    // Pega os últimos 3 artigos do blog (o que resolve o erro da variável)
    $artigos = Post::latest()->take(3)->get(); 
    
    // Entrega a view passando as duas variáveis coletadas do banco
    return view('welcome', compact('trabalhos', 'artigos'));
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('/dashboard/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    
    // ADICIONE ESTAS NOVAS ROTAS BEM AQUI:
    Route::get('/dashboard/agenda', [AgendamentoController::class, 'index'])->name('agenda.index');
    Route::post('/dashboard/agenda', [AgendamentoController::class, 'store'])->name('agenda.store');
    
    Route::get('/dashboard/blog', [PostController::class, 'index'])->name('blog.index');
    Route::post('/dashboard/blog', [PostController::class, 'store'])->name('blog.store');
});


// Rota pública para ler um artigo completo usando o slug
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('publico.blog.show');


// Rota que recebe os dados do formulário de agendamento do site público
Route::post('/agendar-visita', [AgendamentoController::class, 'store'])->name('publico.agendar');

// Rota para a Página dedicada de Portfólio Público
// Rota para a Página dedicada de Portfólio Público
Route::get('/portfolio', function () {
    // Substitua ->get() por ->paginate(12)
    $trabalhos = \App\Models\Portfolio::latest()->paginate(12); 
    return view('paginas.portfolio', compact('trabalhos'));
})->name('publico.portfolio');

// Rota para a Página dedicada de Blog Público
Route::get('/blog', function () {
    // Substitua ->get() por ->paginate(6)
    $artigos = \App\Models\Post::latest()->paginate(6); 
    return view('paginas.blog', compact('artigos'));
})->name('publico.blog');


// Rota para a Página dedicada de Agenda/Reserva Pública
Route::get('/agenda', function () {
    return view('paginas.agenda');
})->name('publico.agenda');


require __DIR__.'/auth.php';
