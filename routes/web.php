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
use App\Http\Controllers\RelatorioPdfController;
use App\Livewire\Usuarios\Index as UsuarioIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/cadastro', RegisterEmpresa::class)
    ->name('cadastro');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'trial'])
    ->name('dashboard');

Route::get('/checkout', function () {
    return view('checkout');
})->middleware(['auth'])->name('checkout');

Route::get('/categorias', CategoriaIndex::class)
    ->middleware(['auth', 'trial'])
    ->name('categorias.index');

Route::get('/produtos', ProdutoIndex::class)
    ->middleware(['auth', 'trial'])
    ->name('produtos.index');

Route::get('/movimentacoes', MovimentacaoIndex::class)
    ->middleware(['auth', 'trial'])
    ->name('movimentacoes.index');

Route::get('/clientes', ClienteIndex::class)
    ->middleware(['auth', 'trial'])
    ->name('clientes.index');

Route::get('/vendas', VendaIndex::class)
    ->middleware(['auth', 'trial'])
    ->name('vendas.index');

Route::get('/relatorios', RelatorioIndex::class)
    ->middleware(['auth', 'trial'])
    ->name('relatorios.index');

Route::get('/relatorios/pdf', [RelatorioPdfController::class, 'vendas'])
    ->middleware(['auth', 'trial'])
    ->name('relatorios.pdf');

Route::get('/configuracoes', ConfiguracaoIndex::class)
    ->middleware(['auth', 'trial', 'admin'])
    ->name('configuracoes.index');

Route::get('/assinatura', AssinaturaIndex::class)
    ->middleware(['auth', 'admin'])
    ->name('assinatura.index');

Route::get('/usuarios', UsuarioIndex::class)
    ->middleware(['auth', 'trial', 'admin'])
    ->name('usuarios.index');


use App\Http\Controllers\MercadoPagoController;

Route::post('/checkout/pix', [MercadoPagoController::class, 'gerarPix'])
    ->middleware('auth')
    ->name('checkout.pix.gerar');

Route::get('/checkout/pix/{id}', [MercadoPagoController::class, 'pix'])
    ->middleware('auth')
    ->name('checkout.pix');

    
require __DIR__ . '/auth.php';