<?php

use App\Http\Livewire\Inc\App;
use App\Http\Livewire\Inc\Social;
use App\Http\Livewire\Inc\Songlist;
use App\Http\Livewire\SingleSong;
use App\Http\Livewire\Upload;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', Songlist::class);
Route::get('/single/{user}/{slug}', SingleSong::class);
Route::get('/upload', Upload::class)->name('upload');
Route::get('/login/{social}', Social::class);
//Route::fallback('/', Songlist::class);












Route::get('/social/{social}', function($social){
   // session()->put('previous-url', url()->previous());
    return   Socialite::driver($social)->redirect();
})->name('social');


