<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/experience', ExperienceController::class)->name('experience');
Route::inertia('/schooling', 'Schooling')->name('schooling');
Route::inertia('/projects', 'Projects')->name('projects');
