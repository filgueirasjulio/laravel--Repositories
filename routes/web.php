<?php

Route::get('admin', function () {
})->name('admin');

// Rotas de pesquisa
Route::any('admin/products/search', 'Admin\ProductController@search')->name('products.search');
Route::any('admin/categories/search', 'Admin\CategoryController@search')->name('categories.search');


Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::resource('admin/categories', 'Admin\CategoryController');
    Route::resource('admin/products', 'Admin\ProductController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
