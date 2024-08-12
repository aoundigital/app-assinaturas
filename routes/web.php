<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssinaturasController;
use App\Http\Controllers\AtivoController;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\PagamentosController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // assinaturas
    Route::get('/dashboard', [AssinaturasController::class, 'index'])->name('dashboard');
    Route::get('/sozinho/{id}', [AssinaturasController::class, 'sozinho'])->name('ass.sozinho')->middleware('auth');
    Route::get('/admin/basico', [AssinaturasController::class, 'basico'])->name('admin.basico')->middleware('auth');
    Route::get('/admin/regular', [AssinaturasController::class, 'regular'])->name('admin.regular')->middleware('auth');
    Route::get('/admin/completo', [AssinaturasController::class, 'completo'])->name('admin.completo')->middleware('auth');
    Route::get('/admin/pbn', [AssinaturasController::class, 'pbn'])->name('admin.pbn')->middleware('auth');
    Route::get('/admin/pbn_sinais', [AssinaturasController::class, 'pbn_sinais'])->name('admin.pbn_sinais')->middleware('auth');
    Route::get('/admin/blog_ecom', [AssinaturasController::class, 'blog_ecom'])->name('admin.blog_ecom')->middleware('auth');
    Route::get('/criar/assinatura', [AssinaturasController::class, 'criar'])->name('criar.assinatura')->middleware('auth');
    Route::post('/criar/assinatura', [AssinaturasController::class, 'create'])->name('create.assinatura')->middleware('auth');
    Route::get('/del/{id}', [AssinaturasController::class, 'del'])->name('del.assinatura')->middleware('auth');
    Route::get('/voltou/{id}', [AssinaturasController::class, 'voltar_excluidos'])->name('voltou.assinatura')->middleware('auth');
    Route::get('admin/excluido', [AssinaturasController::class, 'excluidos'])->name('excluidos.assinatura')->middleware('auth');
    // pagamentos
    Route::get('/criar/pagamento', [PagamentosController::class, 'criar'])->name('criar.pagemento')->middleware('auth');
    Route::post('/criar/pagamentos', [PagamentosController::class, 'create'])->name('create.pagementos')->middleware('auth');
    Route::get('/criar/pagamento/{id}', [PagamentosController::class, 'criar_uma'])->name('criar_uma.pagemento')->middleware('auth');
    Route::get('/pagamentos/geral', [PagamentosController::class, 'index'])->name('index.pagemento')->middleware('auth');
    Route::get('/pagamentos/buscar/', [PagamentosController::class, 'buscar_data'])->name('buscar.pagemento')->middleware('auth');
    Route::post('/pagamentos/buscar/', [PagamentosController::class, 'buscar_data'])->name('buscar.pagemento')->middleware('auth');
    Route::get('/pagamentos/deletar/{id}', [PagamentosController::class, 'deletar'])->name('deletar.pagemento')->middleware('auth');
    Route::get('/pagamentos/apagar/{id}', [PagamentosController::class, 'apagar'])->name('apagar.pagemento')->middleware('auth');
    // ativo
    Route::get('/ativar/{id}/{cliente_id}', [AtivoController::class, 'ativar'])->name('ativar')->middleware('auth');
    Route::get('/desativar/{id}/{cliente_id}', [AtivoController::class, 'desativar'])->name('desativar')->middleware('auth');
    // entregas
    Route::get('/entregas', [EntregasController::class, 'index'])->name('index.entregas')->middleware('auth');
    Route::get('/entregas/{id}', [EntregasController::class, 'entrega_id'])->name('id.entregas')->middleware('auth');
    Route::post('/entregas/criar', [EntregasController::class, 'create'])->name('create.entrega')->middleware('auth');
    Route::get('/entregas/deletar/{id}', [EntregasController::class, 'deletar'])->name('deletar.entrega')->middleware('auth');

});

require __DIR__.'/auth.php';
