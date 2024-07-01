<?php
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

Route::get('/', function () {
    return view('home');
});

//User Routes

Route::group(['prefix'=>'account'],function(){

    //Guest middleware
    Route::group(['middleware'=>'guest'], function(){
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('register', [LoginController::class, 'processRegister'])->name('account.processRegister');

    });

    //Authenticated middleware
    Route::group(['middleware'=>'auth'], function(){
        Route::post('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('account.dashboard');
                
    });
});


// Admin Routes

Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('/',[AdminLoginController::class,'login'])->name('admin.login');
        Route::get('login',[AdminLoginController::class,'login'])->name('admin.login');
        Route::post('login',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
       
    });

    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('dashboard',[AdminDashboardController::class,'dashboard'])->name('admin.dashboard');
        Route::get('createBlog',[AdminDashboardController::class,'createBlog'])->name('admin.createBlog');
        Route::post('logout',[AdminLoginController::class,'logout'])->name('admin.logout');
        Route::get('createBlog',[PostController::class,'createBlog'])->name('admin.createBlog');
        Route::post('createBlog',[PostController::class,'processCreateBlog'])->name('admin.processCreateBlog');
        Route::get('blogs',[BlogsController::class,'blogs'])->name('admin.blogs');
        Route::get('editPost/{id}/edit',[PostController::class,'editPost'])->name('admin.editPost');
        Route::post('updatePost/{id}/edit',[PostController::class,'updatePost'])->name('admin.updatePost');


    });
});




