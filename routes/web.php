<?php

use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('contact-form'); // страница с формой
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

