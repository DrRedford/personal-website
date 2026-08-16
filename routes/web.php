<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolingController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/experience', ExperienceController::class)->name('experience');
Route::get('/schooling', SchoolingController::class)->name('schooling');
Route::inertia('/projects', 'Projects')->name('projects');
