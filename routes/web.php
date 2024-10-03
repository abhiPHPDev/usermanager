<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/',  [HomeController::class, 'index'])->name('users');
Route::post('/store',  [HomeController::class, 'store'])->name('user-store');
Route::post('/list',  [HomeController::class, 'userlist'])->name('user-list');

Route::post('/getuserdetail',  [HomeController::class, 'getuserdetail'])->name('getuserdetail');




//User roles

/**********************************Roles********************** */
Route::get('/staff-roles', [HomeController::class, 'staffroles'])->name('staff-roles');
Route::post('/roles-list', [HomeController::class, 'staffrolelist'])->name('staffrolelist');
// Route::match(['GET','POST'],'/managerole', [HomeController::class, 'managerole'])->name('addrole');
Route::post('/storerole',  [HomeController::class, 'storerole'])->name('userrole-store');
Route::post('/getroledetail',  [HomeController::class, 'getroledetail'])->name('getroledetail');