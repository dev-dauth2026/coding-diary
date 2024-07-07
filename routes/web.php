<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChangeUserName;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

Route::get('/', function () {
    return view('home');
});

//User Routes

Route::group(['prefix'=>'account'],function(){

    Route::get('about', [LoginController::class, 'about'])->name('account.about');
    Route::get('contact', [LoginController::class, 'contact'])->name('account.contact');
    Route::get('blog', [PostController::class, 'blog'])->name('account.blog');
    //Guest middleware
    Route::group(['middleware'=>'guest'], function(){
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        // Route::get('forgotPassword', [LoginController::class, 'forgotPassword'])->name('account.forgotPassword');
        // Route::post('password/email', [LoginController::class, 'sendResetLinkEmail'])->name('account.sendResetLinkEmail');
        // Route::post('passwordReset', [LoginController::class, 'passwordResetPost'])->name('account.passwordResetPost');

       

        
    });

    //Authenticated middleware
    Route::group(['middleware'=>'auth'], function(){
        Route::post('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('account.dashboard');
        Route::get('account', [DashboardController::class, 'account'])->name('account.account');
        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::put('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        Route::put('password/change',[ChangePasswordController::class,'changePassword'])->name('password.change');
        Route::put('username/change',[ChangeUserName::class,'changeUserName'])->name('username.change');
        Route::put('profile_picture/change',[ChangeUserName::class,'changeProfilePicture'])->name('profile_picture.change');
                
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
        Route::get('createBlog',[AdminPostController::class,'createBlog'])->name('admin.createBlog');
        Route::post('createBlog',[AdminPostController::class,'processCreateBlog'])->name('admin.processCreateBlog');
        Route::get('blogs',[BlogsController::class,'blogs'])->name('admin.blogs');
        Route::get('editPost/{id}/edit',[AdminPostController::class,'editPost'])->name('admin.editPost');
        Route::post('updatePost/{id}/edit',[AdminPostController::class,'updatePost'])->name('admin.updatePost');
        Route::delete('post/{id}',[AdminPostController::class,'deletePost'])->name('admin.deletePost');


    });
});




