<?php

use App\Http\Controllers\ExperienceController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');
Route::get('/experience', ExperienceController::class)->name('experience');
Route::inertia('/schooling', 'Schooling')->name('schooling');
Route::inertia('/projects', 'Projects')->name('projects');
