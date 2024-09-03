<?php

use App\Http\Controllers\user\UserActivitiesController;
use App\Http\Controllers\user\UserNotificationsController;
use App\Http\Controllers\user\UserSettingsController;
use App\Http\Controllers\user\WatchedBlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\UserMessageController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\user\FavouritePostController;
use App\Http\Controllers\admin\AdminCommentsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\user\ChangePasswordController;
use App\Http\Controllers\user\ChangeUserNameController;
use App\Http\Controllers\admin\AdminUsersListController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\admin\AdminCategoriesController;
use App\Http\Controllers\NewsLetterSubscriptionController;
use App\Http\Controllers\admin\AdminPasswordChangeController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\user\CommentController as UserCommentController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;


//User Routes
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');

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
    Route::get('/verify-email/{id}/{hash}', [LoginController::class, 'verifyEmail'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
    Route::post('subscription/email/verification/resend',[SubscriptionController::class, 'verificationResend'])->name('verification.resend') ;

    Route::post('/blog/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

    //Guest middleware
    Route::group(['middleware'=>'guest'], function(){
        Route::get('login', [LoginController::class, 'login'])->name('account.login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        
        Route::post('/email/verification/resend',[LoginController::class, 'verificationResend'])->name('login.verification.resend') ;

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
    Route::group(['middleware'=>['auth','verified']], function(){
        Route::post('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('account.dashboard');
        Route::get('account', [DashboardController::class, 'account'])->name('account.account');
        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::put('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        Route::put('password/change',[ChangePasswordController::class,'changePassword'])->name('password.change');
        Route::put('username/change',[ChangeUserNameController::class,'changeUserName'])->name('username.change');
        Route::put('profile_picture/change',[ChangeUserNameController::class,'changeProfilePicture'])->name('profile_picture.change');


        // User Dashboard Favourite page
        Route::post('blog/favourite/{id}', [FavouritePostController::class, 'addFavourite'])->name('favourite.add');
        Route::delete('blog/favourites/remove/{favouriteBlog}', [FavouritePostController::class, 'removeFavourite'])->name('favourite.remove');
        Route::get('/dashboard/favourites', [FavouritePostController::class, 'dashboardFavouriteBlog'])->name('account.favourites');

        // User Dashboard Watch List page
        Route::get('/dashboard/watched', [WatchedBlogController::class, 'index'])->name('account.watched');
        Route::post('/blog/watch/{id}', [WatchedBlogController::class, 'store'])->name('watched.add');


        //User Dashboard Comment page
        Route::get('/dashboard/comments', [UserCommentController::class, 'show'])->name('account.comments');
        Route::put('/dashboard/comments/edit/{comment}', [UserCommentController::class, 'update'])->name('account.comments.update');
        Route::delete('/dashboard/comments/{comment}', [UserCommentController::class, 'destroy'])->name('account.comments.destroy');
        Route::post('/dashboard/comments/reply/{comment}', [UserCommentController::class, 'store'])->name('account.comments.reply');

        // User Dashboard Message page
        Route::get('/user/messages', [UserMessageController::class, 'index'])->name('account.messages.index');
        Route::get('/user/messages/{message}', [UserMessageController::class, 'show'])->name('account.messages.show');
        Route::post('/user/messages/{message}/reply', [UserMessageController::class, 'reply'])->name('account.messages.reply');
        Route::delete('/user/messages/{message}', [UserMessageController::class, 'destroy'])->name('account.messages.destroy');
        Route::post('/user/messages/{message}/mark-read', [UserMessageController::class, 'markRead'])->name('account.messages.markRead');

        // User Dashboard Setting page
        Route::get('/user/settings', [UserSettingsController::class, 'index'])->name('account.settings.index');
        Route::put('/user/settings/privacy', [UserSettingsController::class, 'updatePrivacy'])->name('account.settings.updatePrivacy');
        Route::post('/user/settings/language', [UserSettingsController::class, 'updateLanguage'])->name('account.settings.updateLanguage');
        Route::post('/user/settings/theme', [UserSettingsController::class, 'updateTheme'])->name('account.settings.updateTheme');
        Route::post('/user/settings/email-preferences', [UserSettingsController::class, 'updateEmailPreferences'])->name('account.settings.updateEmailPreferences');
        Route::post('/user/settings/deactivate', [UserSettingsController::class, 'deactivateAccount'])->name('account.settings.deactivate');
        Route::post('/user/settings/2fa', [UserSettingsController::class, 'update2FA'])->name('account.settings.update2FA');
        Route::post('/user/settings/download-data', [UserSettingsController::class, 'downloadData'])->name('account.settings.downloadData');


        // User Dashboard notification page
        Route::get('/account/notifications', [UserNotificationsController::class, 'index'])->name('account.notifications');
        Route::post('/account/notifications/{id}/mark-as-read', [UserNotificationsController::class, 'markAsRead'])->name('account.notifications.markAsRead');

         // User Dashboard notification page
         Route::get('/user/activities', [UserActivitiesController::class, 'index'])->name('account.activities.index');

        Route::put('blog/comments/comment/{id}/edit',[CommentController::class, 'commentEdit'])->name('comment.edit');
        Route::put('blog/comments/{comment}',[CommentController::class, 'commentUpdate'])->name('comment.update');
        Route::delete('blog/comments/{comment}',[CommentController::class, 'destroy'])->name('comment.destroy');
        Route::post('blog/comments/reply/{commentId}',[CommentController::class, 'commentReply'])->name('comment.reply');
        Route::put('blog/comments/reply/{comment}',[CommentController::class, 'updateCommentReply'])->name('comment.reply.update');
        Route::post('blog/comments/like/{commentId}',[CommentController::class, 'likeComment'])->name('comment.like');
        Route::delete('blog/comments/unlike/{commentId}',[CommentController::class, 'unlikeComment'])->name('comment.unlike');

        // Route::delete('/dashboard/favourite/{id}', [FavouritePostController::class, 'removeDashboardFavouriteBlog'])->name('account.favourite.remove');
        
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
        Route::get('profile', [AdminProfileController::class, 'showProfile'])->name('admin.profile');
        Route::put('profile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::put('username/change',[AdminProfileController::class,'changeUserName'])->name('admin.username.change');
        Route::put('profile_picture/change',[AdminProfileController::class,'changeProfilePicture'])->name('admin.profile_picture.change');
        Route::delete('profile_picture/remove',[AdminProfileController::class,'destroyProfilePicture'])->name('admin.profile_picture.destroy');

        Route::put('profile/password/change',[AdminProfileController::class,'changePassword'])->name('admin.password.change');
        // Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
        // Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
        // Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
        // Route::put('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');

        Route::get('blogs',[AdminPostController::class,'blogs'])->name('admin.blogs');
        Route::get('blogs/create',[AdminPostController::class,'create'])->name('admin.blog.create');
        Route::post('blogs',[AdminPostController::class,'store'])->name('admin.store');
        Route::get('blogs/{post}/edit',[AdminPostController::class,'editPost'])->name('admin.post.edit');
        Route::put('blogs/{post}',[AdminPostController::class,'update'])->name('admin.post.update');
        Route::put('blogs/status/{post}',[AdminPostController::class,'updateStatus'])->name('admin.post.status.update');
        Route::put('blogs/category/{post}',[AdminPostController::class,'updateCategory'])->name('admin.post.category.update');
        Route::delete('blogs/{post}',[AdminPostController::class,'destroy'])->name('admin.post.delete');

        Route::get('users',[AdminUsersListController::class,'users'])->name('admin.users');
        Route::put('users/{user}/update-role',[AdminUsersListController::class,'roleUpdate'])->name('admin.roles.update');
        Route::get('users/{user}/edit',[AdminUsersListController::class,'userEdit'])->name('admin.user.edit');
        Route::put('users/{user}/update',[AdminUsersListController::class,'userUpdate'])->name('admin.user.update');
        Route::delete('users/{user}',[AdminUsersListController::class,'userDestroy'])->name('admin.user.delete');

        Route::get('blogs/category',[AdminCategoriesController::class,'blogCategory'])->name('admin.blog.category');
        Route::get('blogs/category/create',[AdminCategoriesController::class,'createCategoryFormShow'])->name('admin.category.create');
        Route::post('blogs/categories',[AdminCategoriesController::class,'store'])->name('admin.category.store');
        Route::get('blogs/categories/{category}',[AdminCategoriesController::class,'editCategory'])->name('admin.category.edit');
        Route::put('blogs/categories/{category}',[AdminCategoriesController::class,'updateCategory'])->name('admin.category.update');
        Route::delete('blogs/categories/{category}',[AdminCategoriesController::class,'destroyCategory'])->name('admin.category.delete');

        Route::get('comments',[AdminCommentsController::class,'comments'])->name('admin.comments');
        Route::get('comments/{comment}',[AdminCommentsController::class,'editComments'])->name('admin.comments.edit');
        Route::put('comments/{comment}',[AdminCommentsController::class,'updateComments'])->name('admin.comments.update');
        Route::delete('comments/{comment}',[AdminCommentsController::class,'destroy'])->name('admin.comments.delete');
        Route::post('blogs/comments/reply/{comment_id}',[AdminCommentsController::class,'reply'])->name('admin.comments.reply');

        Route::post('logout',[AdminLoginController::class,'logout'])->name('admin.logout');


    });
});

