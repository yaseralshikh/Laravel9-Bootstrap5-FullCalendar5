<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Backend\Dashboard;
use App\Http\Livewire\Backend\Events\Events;
use App\Http\Livewire\Backend\Users\ListUsers;
use App\Http\Livewire\Backend\Events\ListEvents;
use App\Http\Livewire\Backend\Tasks\Tasks;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth', 'role:admin|superadmin']], function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('users', ListUsers::class)->name('users');
    Route::get('events', ListEvents::class )->name('events');
    Route::get('tasks', Tasks::class )->name('tasks');
    Route::get('events2', Events::class )->name('events2');
});
