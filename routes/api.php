<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register'])->name('users.add');
Route::post('/login', [AuthController::class, 'login'])->name('users.login');


Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::post('/produits/{slug}/passer-commande', [CommandeController::class, 'store'])->name('commandes.add');