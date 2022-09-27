<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TagController;
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

// route de la section Catégorie
Route::get('/categorie', [CategoryController::class, 'list'])->name('category-list');
Route::get('/categorie/ajout', [CategoryController::class, 'add'])->name('category-add');
Route::post('/categorie/creer', [CategoryController::class, 'create'])->name('category-create');
Route::get('/categorie/modifier/{id}', [CategoryController::class, 'edit'])->name('category-edit')->whereNumber('id');
Route::post('/categorie/update/{id}', [CategoryController::class, 'update'])->name('category-update')->whereNumber('id');
Route::get('/categorie/ordre', [CategoryController::class, 'order'])->name('category-order');
Route::get('/categorie/{id}', [CategoryController::class, 'delete'])->name('category-delete')->whereNumber('id');

// routes de la section Marque
Route::get('/marque', [BrandController::class, 'list'])->name('brand-list');
Route::get('/marque/ajout', [BrandController::class, 'add'])->name('brand-add');
Route::post('/marque/creer', [BrandController::class, 'create'])->name('brand-create');
Route::get('/marque/modifier/{id}', [BrandController::class, 'edit'])->name('brand-edit')->whereNumber('id');
Route::post('/marque/update/{id}', [BrandController::class, 'update'])->name('brand-update')->whereNumber('id');
Route::get('/marque/{id}', [BrandController::class, 'delete'])->name('brand-delete')->whereNumber('id');

// routes de la section Type
Route::get('/type', [TypeController::class, 'list'])->name('type-list');
Route::get('/type/ajout', [TypeController::class, 'add'])->name('type-add');
Route::post('/type/creer', [TypeController::class, 'create'])->name('type-create');
Route::get('/type/modifier/{id}', [TypeController::class, 'edit'])->name('type-edit')->whereNumber('id');
Route::post('/type/update/{id}', [TypeController::class, 'update'])->name('type-update')->whereNumber('id');
Route::get('/type/{id}', [TypeController::class, 'delete'])->name('type-delete')->whereNumber('id');

// routes de la section Type
Route::get('/tag', [TagController::class, 'list'])->name('tag-list');
Route::get('/tag/ajout', [TagController::class, 'add'])->name('tag-add');
Route::post('/tag/creer', [TagController::class, 'create'])->name('tag-create');
Route::get('/tag/modifier/{id}', [TagController::class, 'edit'])->name('tag-edit')->whereNumber('id');
Route::post('/tag/update/{id}', [TagController::class, 'update'])->name('tag-update')->whereNumber('id');
Route::get('/tag/{id}', [TagController::class, 'delete'])->name('tag-delete')->whereNumber('id');

// routes de la section Produit
Route::get('/produit', [ProductController::class, 'list'])->name('product-list');
Route::get('/produit/ajout', [ProductController::class, 'add'])->name('product-add');
Route::post('/produit/creer', [ProductController::class, 'create'])->name('product-create');
Route::get('/produit/modifier/{id}', [ProductController::class, 'edit'])->name('product-edit')->whereNumber('id');
Route::post('/produit/update/{id}', [ProductController::class, 'update'])->name('product-update')->whereNumber('id');
Route::get('/produit/{id}', [ProductController::class, 'delete'])->name('product-delete')->whereNumber('id');
