<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/checkout', function () {
    return view('checkout');
})->middleware('auth')->name('checkout');

use App\Livewire\Auth\RegisterEmpresa;

Route::get('/cadastro', RegisterEmpresa::class)
    ->name('cadastro');

use App\Livewire\Categorias\Index as CategoriaIndex;

Route::get('/categorias', CategoriaIndex::class)
    ->middleware('auth')
    ->name('categorias.index');

    use App\Livewire\Produtos\Index as ProdutoIndex;

Route::get('/produtos', ProdutoIndex::class)
    ->middleware('auth')
    ->name('produtos.index');

use App\Livewire\Movimentacoes\Index as MovimentacaoIndex;

Route::get('/movimentacoes', MovimentacaoIndex::class)
    ->middleware('auth')
    ->name('movimentacoes.index');

use App\Livewire\Clientes\Index as ClienteIndex;

Route::get('/clientes', ClienteIndex::class)
    ->middleware('auth')
    ->name('clientes.index');

use App\Livewire\Vendas\Index as VendaIndex;

Route::get('/vendas', VendaIndex::class)
    ->middleware('auth')
    ->name('vendas.index');

use App\Livewire\Relatorios\Index as RelatorioIndex;

Route::get('/relatorios', RelatorioIndex::class)
    ->middleware('auth')
    ->name('relatorios.index');

    use App\Livewire\Assinatura\Index as AssinaturaIndex;

Route::get('/assinatura', AssinaturaIndex::class)
    ->middleware('auth')
    ->name('assinatura.index');

    use App\Livewire\Configuracoes\Index as ConfiguracaoIndex;

Route::get('/configuracoes', ConfiguracaoIndex::class)
    ->middleware('auth')
    ->name('configuracoes.index');

    use App\Http\Controllers\RelatorioPdfController;

Route::get('/relatorios/pdf', [RelatorioPdfController::class, 'vendas'])
    ->middleware('auth')
    ->name('relatorios.pdf');

require __DIR__ . '/auth.php';
