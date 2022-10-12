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
    return view('welcome');
});

Route::get('/arsip', 'ArsipController@index');
Route::get('/arsip/cari', 'ArsipController@cari');
Route::get('/arsip/tambah', 'ArsipController@tambah');
Route::post('/arsip/insert', 'ArsipController@insert');
Route::get('/arsip/hapus/{judul}', 'ArsipController@hapus');
Route::get('/arsip/lihat/{judul}', 'ArsipController@lihat');
Route::get('/arsip/edit/{judul}', 'ArsipController@edit');
Route::post('/arsip/edit/update/{judul}', 'ArsipController@update');

Route::get('/arsip/download/{file_surat}', 'ArsipController@download');

Route::get('/about', 'AboutController@index');
