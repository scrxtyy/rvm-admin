<?php

use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\NotifController;
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

Route::get('/notifications', [NotifController::class, 'notifs'])->middleware(['auth','verified'])->name('notifications');

Route::get('/email', [NotifController::class, 'sendEmail']);
Route::get('/simulatePlastics', function(){
    $plastic = new monitorPlastics();
    $plastic = monitorPlastics::create([
        'kg_weight' => 2,
        'pieces' => 200,
        'price' => 20,
        'total_kg' => 5,
        
    ]);
    return redirect()->back();
});

Route::get('/search', [EmployeeCRUDController::class, 'search']);
Route::get('/clearsearch', [EmployeeCRUDController::class, 'clearsearch']);
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
