<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LanguageController;

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

Route::get('/',[PageController::class,'main'] )->name('main');
Route::get('/aboutsalom', [PageController::class, 'about'])->name('about');
Route::get('/services',[PageController::class,'services'])->name('services');
Route::get('/projects',[PageController::class,'projects'])->name('projects');
Route::get('/contact',[PageController::class,'contact'])->name('contact');

Route::get('login',[AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register',[AuthController::class, 'register'])->name('register');
Route::post('register',[AuthController::class, 'register_store'])->name('register.store');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('notifications/{notification}/read',[NotificationController::class, 'read'])->name('notifications');
});




Route::get('language/{locale}', [LanguageController::class, 'change_locale'])->name('locale.change');


Route::resources([
    'posts'=> PostController::class,
    'comments' => CommentController::class,
    'notifications'=> NotificationController::class,
]);








