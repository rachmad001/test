<?php

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

Route::get('/', function () {
    return view('guest');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    session_Start();
    if (!isset($_SESSION["state"])){
        return redirect('/login');
    }
    if ($_SESSION["state"] === "aktif"){
        return view('admin'); 
    }
});

Route::get('/admin/dashboard', function () {
    return view('dashboard');
});

Route::get('/edit/{id}', function($id) {
    return view('edit', ['data' => $id]);
});

Route::get('/read/{id}', function($id) {
    return view('read', ['id' => $id]);
});
