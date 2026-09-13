<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Models\Portfolio;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    // Busca os trabalhos mais recentes salvos no banco
    $trabalhos = Portfolio::latest()->take(6)->get(); 
    
    // Passa esses trabalhos para a página inicial
    return view('welcome', compact('trabalhos'));
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


require __DIR__.'/auth.php';
