<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\RVMController;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use App\Models\monitorPlastics;

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

Route::redirect('/', destination:'login');

Route::resource('/dashboard', EmployeeCRUDController::class)->middleware(['auth','verified']);
Route::get('/dashboard', [EmployeeCRUDController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/employee/{id}', [EmployeeCRUDController::class, 'show'])->middleware(['auth'])->name('emp');

// Route::group(['prefix' => 'rvm'], function () {
//     Route::get('/', [RVMController::class, 'index'])->name('rvm');
//     Route::get('/{id}', [RVMController::class, 'show']);
//     Route::get('/{id}/edit', [RVMController::class, 'edit']);
//     Route::get('/create', [RVMController::class, 'create']);
//     Route::get('{id}/destroy', [RVMController::class, 'destroy']);
// });

Route::post('/testupdate', [NotifController::class, 'testupdate']);
Route::post('/testupdate2', [NotifController::class, 'testupdate2']);
Route::post('/changePassword', [EmployeeCRUDController::class,'changePassword'])->name('changePassword');

// Route::get('/rvms', [EmployeeCRUDController::class, 'rvmTable'])->middleware(['auth','verified'])->name('rvms');

Route::get('/notifications', [NotifController::class, 'notifs'])->middleware(['auth','verified'])->name('notifications');
Route::post('/uploadProof', [NotifController::class, 'uploadProof'])->name('uploadProof');

Route::get('notification/{id}',[NotifController::class,'viewnotif']);

Route::get('/email', [NotifController::class, 'sendEmail']);

Route::get('/sort', [EmployeeCRUDController::class, 'sort'])->name('sort');
Route::get('/sortEmployee', [EmployeeCRUDController::class, 'sortEmployee'])->name('sort');

Route::get('/proof/{id}',[NotifController::class, 'getImage']);

Route::get('/search', [EmployeeCRUDController::class, 'search']);
Route::get('/clearsearch', [EmployeeCRUDController::class, 'clearsearch']);

Route::group(['prefix' => 'employee'], function () {
    Route::get('/{id}', [EmployeeCRUDController::class, 'show']);
    Route::get('/{id}/plastics', [EmployeeCRUDController::class,'showPlastic']);
    Route::get('/{id}/tincans', [EmployeeCRUDController::class,'showTincans']);
    Route::get('/{id}/coins', [EmployeeCRUDController::class, 'showCoins']);
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('/{id}/edit', [EmployeeCRUDController::class, 'edit']);
    Route::get('/{id}/editrvm', [EmployeeCRUDController::class,'editrvm']);
    Route::get('/{id}/editpassword', [EmployeeCRUDController::class,'editpassword']);
});

Route::get('/assign/{id}', [NotifController::class,'assignTask']);

Route::post('/insertassign', [NotifController::class, 'insertAssign']);

Route::get('/notifs/{id}', [NotifController::class, 'employeenotifications'])->name('notifs');

Route::get('/addcoins/{id}',[EmployeeController::class,'addcoins']);
// Route::get('/employees/create', [EmployeeCRUDController::class, 'create'])->middleware(['auth','verified']);
// Route::get('/employees/edit', [EmployeeCRUDController::class, 'edit'])->middleware(['auth','verified']);
// Route::get('/employees/show', [EmployeeCRUDController::class, 'show'])->middleware(['auth','verified']);
// Route::get('/employees/destroy', [EmployeeCRUDController::class, 'destroy'])->middleware(['auth','verified']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// useless routes
// Just to demo sidebar dropdown links active states.
// Route::get('/buttons/text', function () {
//     return view('buttons-showcase.text');
// })->middleware(['auth'])->name('buttons.text');

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
