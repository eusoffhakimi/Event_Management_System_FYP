<?php

use App\Http\Controllers\CMyEventPageController;
use App\Http\Controllers\CProfilePageController;
use App\Http\Controllers\SJoinEventController;
use App\Http\Controllers\SProfilePageController;
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

Route::get('/', function () {
    return view('hai');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/CMyEventPage/index', [CMyEventPageController::class, 'index'])->name('CMyEventPage.index')->middleware('auth');

Route::get('/CMyEventPage/create', [CMyEventPageController::class, 'create'])->name('CMyEventPage.create')->middleware('auth');

Route::post('/CMyEventPage/storeEvent', [CMyEventPageController::class, 'storeEvent'])->name('CMyEventPage.storeEvent')->middleware('auth');

Route::get('/CMyEventPage/edit/{eventId}', [CMyEventPageController::class, 'edit'])->name('CMyEventPage.edit')->middleware('auth');

Route::put('/CMyeventPage/updateEvent/{event}', [CMyEventPageController::class, 'updateEvent'])->name('CMyEventPage.updateEvent')->middleware('auth');

Route::get('/CMyEventPage/editParticipant/{event}', [CMyEventPageController::class, 'editParticipant'])->name('CMyEventPage.editParticipant')->middleware('auth');

Route::delete('/CMyEventPage/deleteParticipant/{participant}', [CMyEventPageController::class, 'deleteParticipant'])->name('CMyEventPage.deleteParticipant')->middleware('auth');

Route::get('/CMyEventPage/showDetail/{eventId}', [CMyEventPageController::class, 'showDetail'])->name('CMyEventPage.showDetail')->middleware('auth');

Route::get('/CMyEventPage/showOutcome/{eventId}', [CMyEventPageController::class, 'showOutcome'])->name('CMyEventPage.showOutcome')->middleware('auth');

Route::post('/CMyEventPage/blastEvent/{event}', [CMyEventPageController::class, 'blastEvent'])->name('CMyEventPage.blastEvent')->middleware('auth');

Route::delete('/CMyEventPage/deleteEvent/{eventId}', [CMyEventPageController::class, 'deleteEvent'])->name('CMyEventPage.deleteEvent')->middleware('auth');

Route::get('/CMyEventPage/resultCollaborative', [CMyEventPageController::class, 'resultCollaborative'])->name('CMyEventPage.resultCollaborative')->middleware('auth');

Route::get('/CProfilePage/edit', [CProfilePageController::class, 'edit'])->name('CProfilePage.edit')->middleware('auth');

Route::put('/CProfilePage/updateProfile', [CProfilePageController::class, 'updateProfile'])->name('CProfilePage.updateProfile')->middleware('auth');

Route::put('/CProfilePage/updatePassword', [CProfilePageController::class, 'updatePassword'])->name('CProfilePage.updatePassword')->middleware('auth');

Route::put('/CProfilePage/updatePicture', [CProfilePageController::class, 'updatePicture'])->name('CProfilePage.updatePicture')->middleware('auth');

Route::put('/CProfilePage/updateDetail', [CProfilePageController::class, 'updateDetail'])->name('CProfilePage.updateDetail')->middleware('auth');

Route::get('/SJoinEvent/index', [SJoinEventController::class, 'index'])->name('SJoinEvent.index')->middleware('auth');

Route::post('/SJoinEvent/verifyEventCode', [SJoinEventController::class, 'verifyEventCode'])->name('SJoinEvent.verifyEventCode')->middleware('auth');

Route::get('/SJoinEvent/showDetail/{eventId}', [SJoinEventController::class, 'showDetail'])->name('SJoinEvent.showDetail')->middleware('auth');

Route::post('/SJoinEvent/storeParticipant/{event}', [SJoinEventController::class, 'storeParticipant'])->name('SJoinEvent.storeParticipant')->middleware('auth');

Route::get('/SJoinEvent/editRating/{eventId}', [SJoinEventController::class, 'editRating'])->name('SJoinEvent.editRating')->middleware('auth');

Route::post('/SJoinEvent/storeRating/{event}', [SJoinEventController::class, 'storeRating'])->name('SJoinEvent.storeRating')->middleware('auth');

Route::get('/SProfilePage/edit', [SProfilePageController::class, 'edit'])->name('SProfilePage.edit')->middleware('auth');

Route::put('/SProfilePage/updateProfile', [SProfilePageController::class, 'updateProfile'])->name('SProfilePage.updateProfile')->middleware('auth');

Route::put('/SProfilePage/updatePassword', [SProfilePageController::class, 'updatePassword'])->name('SProfilePage.updatePassword')->middleware('auth');

Route::put('/SProfilePage/updatePicture', [SProfilePageController::class, 'updatePicture'])->name('SProfilePage.updatePicture')->middleware('auth');

Route::put('/SProfilePage/updateDetail', [SProfilePageController::class, 'updateDetail'])->name('SProfilePage.updateDetail')->middleware('auth');

Route::get('bot/updateTele', [CMyEventPageController::class, 'updateTele']);

require __DIR__.'/auth.php';
