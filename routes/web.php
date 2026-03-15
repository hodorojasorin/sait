<?php

use App\Http\Controllers\CampanieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampanieController::class, 'index'])->name('home');

Route::resource('campanii', CampanieController::class)
    ->parameters(['campanii' => 'campanie'])
    ->except('show');
