<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DictionaryController;

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

Route::get('/', function () {
    return view('welcome');
})->name('show.welcome');

Route::post('/', [DictionaryController::class, 'registerToDictionary'])
    ->name('register.to.dictionary');

Route::get('/view', [DictionaryController::class, 'showWordList'])
    ->name('show.word.list');

Route::get('/search', [DictionaryController::class, 'showSearchPage'])
    ->name('show.search.page');

Route::post('/search/result', [DictionaryController::class, 'searchForWords'])
    ->name('search.for.words');

Route::get('/edit', [DictionaryController::class, 'showEditPage'])
    ->name('show.edit.page');

Route::get('/edit/form', [DictionaryController::class, 'showEditForm'])
    ->name('show.edit.form');

Route::post('/edit', [DictionaryController::class, 'editWord'])
    ->name('edit.word');

Route::get('/reset', [DictionaryController::class, 'resetDictionary'])
    ->name('reset.dictionary');

Route::get('/edit/delete', [DictionaryController::class, 'deleteWord'])
    ->name('delete.word');

Route::get('/testSettings', [DictionaryController::class, 'showTestSettingsPage'])
    ->name('show.test.settings.page');

Route::get('/test', [DictionaryController::class, 'showTestPage'])
    ->name('show.test.page');