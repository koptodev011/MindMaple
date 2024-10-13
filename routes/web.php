<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




//Monymanagement routes
Route::get('/earningexpence', [App\Http\Controllers\Earningexpencecontroller::class, 'Earningexpence'])->name('Earningexpence');
Route::post('addearning',[App\Http\Controllers\Earningexpencecontroller::class, 'Addearning'])->name('Addearning');
Route::get('/editearning/{id}',  [App\Http\Controllers\Earningexpencecontroller::class, 'Editearning'])->name('Editearning');
Route::post('updateearning/{id}',[App\Http\Controllers\Earningexpencecontroller::class, 'Updateearning'])->name('updateearning');
Route::delete('/deleteearning/{id}', [App\Http\Controllers\Earningexpencecontroller::class, 'Deleteearning'])->name('Deleteearning');



//Monthexpence routes
Route::get('/expence', [App\Http\Controllers\Expencecontroller::class, 'expence'])->name('Expence');
Route::post('addexpence',[App\Http\Controllers\Expencecontroller::class, 'Addexpence'])->name('Addexpence');
