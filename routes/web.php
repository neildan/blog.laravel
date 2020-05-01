<?php

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

// Ejemplo ruta básica
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*

// Ejemplo ruta que referencia a otra ruta mediante el nombre
Route::get('hola/{name}', function ($name) {
    return "<h1>Hola $name, sobre <a href='".route("postpc")."'>nosotros</a></h1>";
});

// Ejemplo de ruta con nombre
Route::get('sobre-nosotros', function () {
    return "<h1>Toda la información sobre nosotros</h1>";
})->name("nosotros");

// Ejemplo de ruta de con nombre e implementación view
Route::get('home/{nombre?}/{apellido?}', function($nombre = 'Daniel', $apellido = 'Valencia') {
    return view('home', ['nombre' => $nombre, 'apellido' => $apellido]);
})->name("home");

*/

// Ejemplo de ruta utilizando controlador
// Route::get('post', 'PostController@index')->name("postpc");

// Ejemplo de ruta resource

// Rutas Post
Route::resource('dashboard/post', 'dashboard\PostController');
Route::post('dashboard/post/{post}/image', 'dashboard\PostFileController@uploadImage')->name('post.image');

// Ruta Categoría
Route::resource('dashboard/category', 'dashboard\CategoryController');
Route::resource('dashboard/user', 'dashboard\UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
