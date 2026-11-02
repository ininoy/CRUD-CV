<?php

use App\Http\Controllers\BiodataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('biodata.index');
});

Route::resource('biodata', BiodataController::class);
Route::get('biodata/{id}/cv', [BiodataController::class, 'cv'])->name('biodata.cv');

Route::post('biodata/{biodata_id}/pendidikan', [BiodataController::class, 'storePendidikan'])->name('pendidikan.store');
Route::delete('pendidikan/{id}', [BiodataController::class, 'destroyPendidikan'])->name('pendidikan.destroy');
