<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeUserName;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\NewsLetterSubscriptionController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;


//User Routes

Route::get('/', [HomeController::class, 'index'])->name('account.home');
Route::group(['prefix'=>'account'],function(){
    Route::get('about', [LoginController::class, 'about'])->name('account.about');
    Route::get('contact', [ContactController::class, 'contact'])->name('account.contact');
    Route::post('contact', [ContactController::class, 'processContact'])->name('account.processContact');
    Route::get('blog', [PostController::class, 'blog'])->name('account.blog');
    Route::get('blog/{id}', [PostController::class, 'blogDetail'])->name('blog.detail');
    Route::get('all-blogs', [PostController::class, 'allBlogs'])->name('account.allBlogs');
    Route::get('blog-search', [PostController::class, 'blogSearch'])->name('blog.search');
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [SubscriptionController::class, 'verifyEmail'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
    Route::post('/email/verification/resend',[SubscriptionController::class, 'verificationResend'])->name('verification.resend') ;

    //Guest middleware
    Route::group(['middleware'=>'guest'], function(){
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('account.forgotPassword');
        Route::post('password/email', [LoginController::class, 'sendResetLinkEmail'])->name('account.sendResetLinkEmail');
        // Route::post('passwordReset', [LoginController::class, 'passwordResetPost'])->name('account.passwordResetPost');

        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

       

        
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





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
