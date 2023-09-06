<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return redirect()->route('project.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ProjectController::class)->group(function () {
    Route::get('/index', 'index' )->name('project.index');
});


require __DIR__.'/auth.php';


Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index')->name('project.index');
    Route::get('/project/view/{project_id}', 'view')->name('project.view');
    Route::get('/add-project', 'create')->name('project.create'); //Cria
    Route::post('/add-project', 'store')->name('project.store');
    Route::get('/project/edit/{project_id}', 'edit')->name('project.edit'); //Edita
    Route::put('/project/edit/{project_id}', 'update')->name('project.update'); //Atualiza
    Route::delete('/project/delete/{project_id}', 'destroy')->name('project.delete'); //Deleta
    Route::get('/download-pdf/{filename}', 'downloadPDF')->name('download.pdf');
    Route::get('project/download/{project_id}', 'downloadProjectFiles')->name('project.download');
});
