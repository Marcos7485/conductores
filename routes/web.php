<?php

use App\Http\Controllers\AutosController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Main');
});


Route::get('/test', [AutosController::class, 'test']);