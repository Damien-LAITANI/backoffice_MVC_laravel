<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;
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
Route::get('/categorie/modifier/{id}', [CategoryController::class, 'edit'])->name('category-edit');
Route::get('/categorie/ordre', [CategoryController::class, 'order'])->name('category-order');
