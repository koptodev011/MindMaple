<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
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
Route::get('/edit-expense/{id}',[App\Http\Controllers\Expencecontroller::class, 'editExpence'])->name('editExpence');
Route::post('updateexpence/{id}',[App\Http\Controllers\Expencecontroller::class, 'Updateexpence'])->name('updateexpence');
Route::delete('/deleteexpence/{id}', [App\Http\Controllers\Expencecontroller::class, 'Deleteexpence'])->name('Deleteexpence');

//Edusectional management routes
Route::get('/edusection', [App\Http\Controllers\Educationalmanagementcontroller::class, 'Edusection'])->name('Edusection');
Route::post('addedusection',[App\Http\Controllers\Educationalmanagementcontroller::class, 'Addedusection'])->name('Addedusection');
Route::get('/edit-section/{id}',[App\Http\Controllers\Educationalmanagementcontroller::class, 'editsection'])->name('editsection');
Route::post('updatesection/{id}',[App\Http\Controllers\Educationalmanagementcontroller::class, 'Updatesection'])->name('Updatesection');
Route::delete('/deletesection/{id}', [App\Http\Controllers\Educationalmanagementcontroller::class, 'Deletesection'])->name('Deletesection');
Route::get('/edit-subject/{id}',[App\Http\Controllers\Educationalmanagementcontroller::class, 'editsubject'])->name('editsubject');
Route::post('updatesubject/{id}',[App\Http\Controllers\Educationalmanagementcontroller::class, 'Updatesubject'])->name('Updatesubject');
Route::delete('/deletesubject/{id}', [App\Http\Controllers\Educationalmanagementcontroller::class, 'Deletesubject'])->name('Deletesubject');

//Sujects of sections
Route::get('/subjects/{id}', [App\Http\Controllers\EducationalManagementController::class, 'subjects'])->name('subjects');

Route::post('addedusubject/{id}', [App\Http\Controllers\Educationalmanagementcontroller::class, 'Addedusubject'])->name('Addedusubject');
Route::post('createroadmap', [App\Http\Controllers\Educationalmanagementcontroller::class, 'Createroadmap'])->name('Createroadmap');


//Investment routes
Route::get('/Investment', [App\Http\Controllers\investmentcontroller::class, 'investment'])->name('investment');
Route::post('addinvestment',[App\Http\Controllers\investmentcontroller::class, 'Addinvestment'])->name('Addinvestment');
Route::get('/edit-investment/{id}',[App\Http\Controllers\investmentcontroller::class, 'editInvestment'])->name('editInvestment');
Route::post('updateinvestment/{id}',[App\Http\Controllers\investmentcontroller::class, 'Updateinvestment'])->name('Updateinvestment');
Route::delete('/Deleteinvestment/{id}', [App\Http\Controllers\investmentcontroller::class, 'Deleteinvestment'])->name('Deleteinvestment');



//View roadmap
Route::get('/viewroadmap', [App\Http\Controllers\Educationalmanagementcontroller::class, 'viewroadmap'])->name('viewroadmap');



//Feature plan
Route::get('/featureplan', [App\Http\Controllers\Educationalmanagementcontroller::class, 'viewroadmap'])->name('viewroadmap');


//History routes
Route::get('/history', [App\Http\Controllers\historycontroller::class, 'viewhistory'])->name('viewhistory');
Route::get('/generate-pdf',[App\Http\Controllers\Pdfcontroller::class, 'generatePDF'])->name('generatePDF');
