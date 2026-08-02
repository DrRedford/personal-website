<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
Route::inertia('/experience', 'Experience')->name('experience');
Route::inertia('/schooling', 'Schooling')->name('schooling');
Route::inertia('/projects', 'Projects')->name('projects');

require __DIR__.'/settings.php';
