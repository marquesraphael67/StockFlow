<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Dashboard;
use App\Livewire\Auth\RegisterEmpresa;
use App\Livewire\Categorias\Index as CategoriaIndex;
use App\Livewire\Produtos\Index as ProdutoIndex;
use App\Livewire\Movimentacoes\Index as MovimentacaoIndex;
use App\Livewire\Clientes\Index as ClienteIndex;
use App\Livewire\Vendas\Index as VendaIndex;
use App\Livewire\Relatorios\Index as RelatorioIndex;
use App\Livewire\Assinatura\Index as AssinaturaIndex;
use App\Livewire\Configuracoes\Index as ConfiguracaoIndex;
use App\Livewire\Usuarios\Index as UsuarioIndex;

use App\Http\Controllers\RelatorioPdfController;
use App\Http\Controllers\MercadoPagoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/cadastro', RegisterEmpresa::class)
    ->name('cadastro');

Route::middleware(['auth', 'trial'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/categorias', CategoriaIndex::class)->name('categorias.index');
    Route::get('/produtos', ProdutoIndex::class)->name('produtos.index');
    Route::get('/movimentacoes', MovimentacaoIndex::class)->name('movimentacoes.index');
    Route::get('/clientes', ClienteIndex::class)->name('clientes.index');
    Route::get('/vendas', VendaIndex::class)->name('vendas.index');
    Route::get('/relatorios', RelatorioIndex::class)->name('relatorios.index');

    Route::get('/relatorios/pdf', [RelatorioPdfController::class, 'vendas'])
        ->name('relatorios.pdf');

    Route::middleware('admin')->group(function () {
        Route::get('/usuarios', UsuarioIndex::class)->name('usuarios.index');
        Route::get('/configuracoes', ConfiguracaoIndex::class)->name('configuracoes.index');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/assinatura', AssinaturaIndex::class)->name('assinatura.index');

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    Route::post('/checkout/pix', [MercadoPagoController::class, 'gerarPix'])
        ->name('checkout.pix.gerar');

    Route::get('/checkout/pix/{id}', [MercadoPagoController::class, 'pix'])
        ->name('checkout.pix');
});

// WEBHOOK FORA DO AUTH
Route::post('/webhook/mercadopago', [MercadoPagoController::class, 'webhook'])
    ->name('mercadopago.webhook');

require __DIR__ . '/auth.php';