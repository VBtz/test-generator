<?php

use App\Http\Controllers\CreateQuestionController;
use App\Http\Controllers\CreateTestController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\PanelController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('migrate', [DatabaseController::class, 'migrate']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function() {
    Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('/panel', [PanelController::class, 'index'])->name('panel');
    Route::get('/create', [CreateTestController::class, 'index'])->name('create');
    Route::get('/settings/test/{test}', [SettingsController::class, 'index'])->name('settings');
    Route::get('/question/{test}/{question?}', [CreateQuestionController::class, 'index'])->name('question');
    Route::get('/test/{id}', [TestController::class, 'index'])->name('test');

    Route::post('/question/save/{test}', [CreateQuestionController::class, 'onCreateQuestion']);
    Route::post('/question/update/{qId}', [CreateQuestionController::class, 'onUpdateQuestion']);
    Route::post('/question/delete', [CreateQuestionController::class, 'onDeleteQuestion']);
    Route::post('/create', [CreateTestController::class, 'onCreate']);
    Route::post('/panel/delete', [PanelController::class, 'onDelete']);
    Route::post('/settings/test/{test}', [SettingsController::class, 'onSaveName']);
});
