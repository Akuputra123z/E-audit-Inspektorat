<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendationsPdfController;

Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});

Route::get('/recommendations/{lhp_id}/pdf', [RecommendationsPdfController::class, 'generate'])
    ->name('recommendations.pdf');
