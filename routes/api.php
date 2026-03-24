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
Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');
Route::post('/categories/add-categorie', [CategorieController::class, 'store'])->name('categories.store');
Route::patch('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.delete');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::post('/produits/add-produit', [ProduitController::class, 'store'])->name('produits.add');
Route::patch('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.edit');
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.delete');
Route::post('/produits/{slug}/passer-commande', [CommandeController::class, 'store'])->name('commandes.add');
Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
Route::patch('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');