<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserOtpAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostsController;
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
/*Front User*/
Route::get('login', [UserOtpAuthController::class, 'index'])->name('login');
Route::post('login', [UserOtpAuthController::class, 'userLogin'])->name('login.user');
Route::get('registration', [UserOtpAuthController::class, 'registration'])->name('registration');
Route::post('registration', [UserOtpAuthController::class, 'registration'])->name('registration.update');
Route::get('review', [UserOtpAuthController::class, 'review'])->name('review');
Route::get('rejection', [UserOtpAuthController::class, 'rejection'])->name('rejection');
Route::post('rejection', [UserOtpAuthController::class, 'rejection'])->name('rejection.update');
Route::get('edit-profile', [UserOtpAuthController::class, 'edit_profile'])->name('edit_profile');
Route::post('edit-profile', [UserOtpAuthController::class, 'updateProfile'])->name('edit_profile.update');
Route::get('mem/{url}', [UserOtpAuthController::class, 'profile_view'])->name('profile.view');
Route::get('profile', [UserOtpAuthController::class, 'profile'])->name('profile');
Route::get('post/{url}', [PostController::class, 'view'])->name('post.view');
Route::get('post', [PostController::class, 'index'])->name('post');
Route::get('add-post', [PostController::class, 'add'])->name('post.add');
Route::post('add-post', [PostController::class, 'update'])->name('post.save');
Route::post('sendOtp', [UserOtpAuthController::class, 'sendOtp'])->name('sendOtp'); 
Route::post('signout', [UserOtpAuthController::class, 'signOut'])->name('signOut');
Route::get('checkProfileUrl/{url}', [UserOtpAuthController::class, 'checkProfileUrl'])->name('checkProfileUrl');
Route::get('remove-photo', [UserOtpAuthController::class, 'removePhoto'])->name('removePhoto');
/*Route::get('dashboard', [UserOtpAuthController::class, 'dashboard']); 
Route::get('login', [UserOtpAuthController::class, 'index'])->name('login');
Route::get('profile', [UserOtpAuthController::class, 'profile'])->name('profile');
Route::post('updateProfile', [UserOtpAuthController::class, 'updateProfile'])->name('login.updateProfile'); 
Route::post('user-login', [UserOtpAuthController::class, 'userLogin'])->name('login.user'); 
Route::post('sendOtp', [UserOtpAuthController::class, 'sendOtp'])->name('sendOtp'); 
Route::post('signout', [UserOtpAuthController::class, 'signOut'])->name('signOut');

Route::get('/posts', [PostController::class, 'index'])->name('posts');		
Route::get('/posts/add', [PostController::class, 'add'])->name('posts.add');	
Route::post('/posts/update', [PostController::class, 'update'])->name('posts.update');	
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');	
Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');	
Route::post('/posts/category', [PostController::class, 'category'])->name('posts.category');*/	

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::group(['prefix'  =>  'admin'], function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/checkLogin', [AdminLoginController::class, 'checkLogin'])->name('admin.checkLogin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
	
	/** Users **/
	Route::get('/users', [UsersController::class, 'index'])->name('admin.users');	
	Route::post('/users/changeStatus', [UsersController::class, 'changeStatus'])->name('admin.users.changeStatus');	
	Route::post('/users/sendMessage', [UsersController::class, 'sendMessage'])->name('admin.users.sendMessage');	
	Route::delete('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');	
	
	/** admin.category **/
	
	Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');		
	Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.category.add');	
	Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');	
	Route::post('/category/update', [CategoryController::class, 'update'])->name('admin.category.update');	
	Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');	
	Route::post('/category/changeStatus', [CategoryController::class, 'changeStatus'])->name('admin.category.changeStatus');	
	
	/** admin.category **/
	
	Route::get('/posts', [PostsController::class, 'index'])->name('admin.posts');		
	Route::get('/posts/add', [PostsController::class, 'add'])->name('admin.posts.add');	
	Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('admin.posts.edit');	
	Route::post('/posts/update', [PostsController::class, 'update'])->name('admin.posts.update');	
	Route::delete('/posts/destroy/{id}', [PostsController::class, 'destroy'])->name('admin.posts.destroy');	
	Route::post('/posts/changeStatus', [PostsController::class, 'changeStatus'])->name('admin.posts.changeStatus');	

});
