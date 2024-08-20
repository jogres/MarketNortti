<?php
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VendaController;

use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');

Route::resource('produtos', ProdutoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('vendas', VendaController::class);
