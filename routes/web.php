<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\RVMController;
use App\Models\Notifications;
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
Route::get('/rvm/{id)',[EmployeeCRUDController::class, 'showEmployee']);
// Route::get('/rvms', [EmployeeCRUDController::class, 'rvmTable'])->middleware(['auth','verified'])->name('rvms');

// Route::group(['prefix' => 'rvm'], function () {
//     Route::get('/', [RVMController::class, 'index'])->name('rvm');
//     Route::get('/{id}', [RVMController::class, 'show']);
//     Route::get('/{id}/edit', [RVMController::class, 'edit']);
//     Route::get('/create', [RVMController::class, 'create']);
//     Route::get('{id}/destroy', [RVMController::class, 'destroy']);
// });
Route::get('/trigger-event', 'NotifController@triggerEvent');
Route::get('/testupdate', [NotifController::class, 'testupdate']);
Route::post('/changePassword', [EmployeeCRUDController::class,'changePassword'])->name('changePassword');

Route::get('/notifications', [NotifController::class, 'notifs'])->middleware(['auth','verified'])->name('notifications');
Route::post('/uploadProof', [NotifController::class, 'uploadProof'])->name('uploadProof');
Route::post('/verifyProof', [NotifController::class, 'verifyProof'])->name('verifyProof');

Route::get('notification/{id}',[NotifController::class,'viewnotif']);

Route::get('/sort', [EmployeeCRUDController::class, 'sort'])->name('sort');
Route::get('/sortEmployee', [EmployeeCRUDController::class, 'sortEmployee'])->name('sort');
Route::get('/filter', [EmployeeCRUDController::class, 'filter']);
Route::get('/filterEmployee', [EmployeeCRUDController::class, 'filterEmployee']);

Route::get('/search', [EmployeeCRUDController::class, 'search']);
Route::get('/clearsearch', [EmployeeCRUDController::class, 'clearsearch']);

Route::group(['prefix' => 'employee'], function () {
    Route::get('/{id}', [EmployeeCRUDController::class, 'show']);
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('/{id}/edit', [EmployeeCRUDController::class, 'edit']);
    Route::get('/{id}/editrvm', [EmployeeCRUDController::class,'editrvm']);
    Route::get('/{id}/editpassword', [EmployeeCRUDController::class,'editpassword']);
});
Route::post('/create', [EmployeeCRUDController::class, 'store']);
Route::get('/assign/{id}', [NotifController::class,'assignTask']);

Route::post('/insertassign', [NotifController::class, 'insertAssign']);

Route::get('/notifs/{id}', [NotifController::class, 'employeenotifications'])->name('notifs');

require __DIR__ . '/auth.php';
