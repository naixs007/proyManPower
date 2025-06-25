<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Oferta;

Route::get('/', function () {
    $ofertas = Oferta::all();
    return view('welcome', compact('ofertas'));
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('inicio',[CandidatoController::class, 'welcome'])->name('candidato.welcome');
Route::post('postular/{ofertaId}', [CandidatoController::class, 'postular'])->name('candidato.postular');

