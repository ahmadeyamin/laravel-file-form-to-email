<?php

use App\Mail\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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

Route::post('submit', function (Request $request) {

    $request->validate([
        'name' => 'required',
        'zip' => 'required|file|max:5000',
    ]);
    
    $path = $request->file('zip')->store('zip');
    Mail::to(env('ADMIN_EMAIL','example@gmail.com'))
      ->send(new File($request->all(),$path));

    return 'Submit Successfull';

})->name('submit');
