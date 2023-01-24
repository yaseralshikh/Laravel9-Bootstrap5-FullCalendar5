<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Backend\Dashboard;
use App\Http\Livewire\Backend\Events\Events;
use App\Http\Livewire\Backend\Users\ListUsers;
use App\Http\Livewire\Backend\Events\ListEvents;
use App\Http\Livewire\Backend\Levels\Levels;
use App\Http\Livewire\Backend\Offices\Office;
use App\Http\Livewire\Backend\Semesters\Semesters;
use App\Http\Livewire\Backend\Specializations\Specializations;
use App\Http\Livewire\Backend\Subtask\Subtask;
use App\Http\Livewire\Backend\Tasks\Tasks;
use App\Http\Livewire\Backend\Weeks\Weeks;

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
    Route::get('specializations', Specializations::class)->name('specializations');
    Route::get('events', ListEvents::class )->name('events');
    Route::get('tasks', Tasks::class )->name('tasks');
    Route::get('subtasks', Subtask::class )->name('subtasks');
    Route::get('levels', Levels::class )->name('levels');
    Route::get('weeks', Weeks::class )->name('weeks');
    Route::get('semesters', Semesters::class )->name('semesters');
    Route::get('offices', Office::class )->name('offices');
    // Route::get('events2', Events::class )->name('events2');
});
