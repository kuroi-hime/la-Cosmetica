<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StatiquesController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register'])->name('users.add');
Route::post('/login', [AuthController::class, 'login'])->name('users.login');


Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store')->middleware('role:admin');
Route::patch('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update')->middleware('role:admin');
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.delete')->middleware('role:admin');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.add')->middleware('role:admin');
Route::patch('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.edit')->middleware('role:admin');
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.delete')->middleware('role:admin');
Route::post('/produits/{slug}', [CommandeController::class, 'store'])->name('commandes.add');
Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
Route::patch('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
Route::get('/statistiques/ventes', [StatiquesController::class, 'ventes'])->name('statistiques.ventes')->middleware('role:admin');
Route::get('/statistiques/most-ordered', [StatiquesController::class, 'populaires'])->name('statistiques.produits_populaires')->middleware('role:admin');
Route::get('/statistiques/products-by-categories', [StatiquesController::class, 'produitsParCategorie'])->name('statistiques.produits_categories')->middleware('role:admin');