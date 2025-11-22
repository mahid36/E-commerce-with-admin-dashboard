<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontendController::class,'index'])->middleware(['auth', 'verified'])->name('index');
//product details

Route::get('/product/details/{slug}',[FrontendController::class,'product_details'])->middleware(['auth', 'verified'])->name('product.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//user
Route::get('/edit/profile',[UserController::class,'edit_profile'])->middleware(['auth', 'verified'])->name('edit_profile');
Route::post('/update/profile',[UserController::class,'update_profile'])->middleware(['auth', 'verified'])->name('update_profile');
Route::post('/update/password',[UserController::class,'update_password'])->middleware(['auth', 'verified'])->name('update_password');

// category
Route::get('add/category', [CategoryController::class, 'add_category'])->middleware(['auth', 'verified'])->name('add.category');
Route::post('store/category', [CategoryController::class, 'store_category'])->middleware(['auth', 'verified'])->name('store.category');

Route::post('store/product', [CategoryController::class, 'store_product'])->middleware(['auth', 'verified'])->name('store.product');


Route::get('category/delete/{id}', [CategoryController::class, 'category_delete'])->middleware(['auth', 'verified'])->name('category.delete');
Route::get('permanent/delete/{id}', [CategoryController::class, 'permanent_delete'])->middleware(['auth', 'verified'])->name('permanent.delete');
Route::get('restore/{id}', [CategoryController::class, 'restore'])->middleware(['auth', 'verified'])->name('restore');
Route::get('/add/subcategory', [CategoryController::class, 'add_subcategory'])->middleware(['auth', 'verified'])->name('add.subcategory');
Route::post('/store/subcategory', [CategoryController::class, 'store_subcategory'])->middleware(['auth', 'verified'])->name('store.subcategory');
Route::get('/del/subcategory/{id}', [CategoryController::class, 'del_subcategory'])->middleware(['auth', 'verified'])->name('del.subcategory');

//Tag
Route:: get('add/tag',[TagController::class,'add_tag'])->middleware(['auth', 'verified'])->name('add.tag');
Route:: post('store/tag',[TagController::class,'store_tag'])->middleware(['auth', 'verified'])->name('store.tag');
Route:: get('delete/tag/{id}',[TagController::class,'delete_tag'])->middleware(['auth', 'verified'])->name('delete.tag');

//Product

Route::get('add/product',[ProductController::class,'add_product'])->middleware(['auth', 'verified'])->name('add.product');
Route::post('store/product',[ProductController::class,'store_product'])->middleware(['auth', 'verified'])->name('store.product');
Route::get('product/list',[ProductController::class,'product_list'])->middleware(['auth', 'verified'])->name('product.list');
Route::get('add/variant',[ProductController::class,'add_variant'])->middleware(['auth', 'verified'])->name('add.variant');
Route::post('add/color',[ProductController::class,'add_color'])->middleware(['auth', 'verified'])->name('add.color');
Route::post('add/size',[ProductController::class,'add_size'])->middleware(['auth', 'verified'])->name('add.size');
Route::get('inventory/{id}',[ProductController::class,'inventory'])->middleware(['auth', 'verified'])->name('inventory');
Route::post('inventory/store/{id}',[ProductController::class,'inventory_store'])->middleware(['auth', 'verified'])->name('inventory.store');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
