<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route de la page home
Route::get('/', [MainController::class, 'home'])->name('home');

// routes de la section Catégorie
Route::get('/categorie', [CategoryController::class, 'list'])->name('category-list');
Route::get('/categorie/ajout', [CategoryController::class, 'add'])->name('category-add');
Route::post('/categorie/creer', [CategoryController::class, 'create'])->name('category-create');
Route::get('/categorie/modifier/{id}', [CategoryController::class, 'edit'])->name('category-edit')->whereNumber('id');
Route::post('/categorie/update/{id}', [CategoryController::class, 'update'])->name('category-update')->whereNumber('id');
Route::get('/categorie/ordre', [CategoryController::class, 'order'])->name('category-order');
Route::get('/categorie/{id}', [CategoryController::class, 'delete'])->name('category-delete')->whereNumber('id');

// routes de la section Produit
Route::get('/produit', [ProductController::class, 'list'])->name('product-list');
Route::get('/produit/ajout', [ProductController::class, 'add'])->name('product-add');
Route::post('/produit/creer', [ProductController::class, 'create'])->name('product-create');
Route::get('/produit/modifier/{id}', [ProductController::class, 'edit'])->name('product-edit')->whereNumber('id');
