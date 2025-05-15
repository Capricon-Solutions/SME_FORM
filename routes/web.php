<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

// Redirect root to form
Route::get('/', function () {
    return redirect()->route('form.show');
});

// Original welcome page (optional)
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form/submit', [FormController::class, 'submitForm'])->name('form.submit');

// New route to view all form submissions
Route::get('/submissions', function() {
    $forms = \App\Models\Form::all();
    return view('submissions', compact('forms'));
});
