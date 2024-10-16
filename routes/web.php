<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;

Route::controller(AuthenticationController::class)->group(function() {
    Route::get('/login', 'view')->name('login');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'registerView');
    Route::post('/register', 'register')->name('post-register');
    Route::get('/profile', 'profile');
    Route::get('/user-profile', 'userProfile');
    Route::post('/update-profile', 'updateProfile')->name('update-profile');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(AdminController::class)->group(function() {
    Route::get('admin/dashboard', 'dashboard')->name('admindashboard');
    Route::get('admin/branch', 'branch');
    Route::get('admin/create-branch', 'createBranch');
    Route::get('admin/update-branch', 'updateBranch');
    Route::get('admin/branch/{id}', 'getBranch');

    Route::get('admin/product', 'product');
    Route::get('admin/create-product', 'createProduct');
    Route::get('admin/update-product', 'updateProduct');
    Route::get('admin/product/{id}', 'getProduct');

    Route::get('admin/post', 'post');
    Route::get('admin/create-post', 'createPost');
    Route::get('admin/update-post', 'updatePost');
    Route::get('admin/post/{id}', 'getPost');

    Route::get('admin/stock', 'stock');
    Route::get('admin/manage-stock/{id}', 'manageStock');
    
    Route::post('add-stock', 'addStock')->name('add-stock');
    Route::post('accept-request', 'acceptStockRequest')->name('accept-request');
    Route::get('admin/activity', 'activity');
});

Route::controller(BranchController::class)->group(function() {
    Route::post('/branch', 'createBranch')->name('branch');
    Route::post('/updatebranch', 'updateBranch')->name('updatebranch');
    Route::get('/branch/{brach}/delete', 'deleteBranch')->name('branch-delete');
    
});

Route::controller(ProductController::class)->group(function() {
    Route::post('/product', 'createProduct')->name('product');
    Route::post('/updateproduct', 'updateProduct')->name('updateproduct');
});

Route::controller(PostController::class)->group(function() {
    Route::post('/post', 'createPost')->name('post');
    Route::post('/updatepost', 'updatePost')->name('updatepost');
});

Route::controller(BranchUserController::class)->group(function() {
    Route::get('branch-user/dashboard', 'dashboard')->name("branchdashboard");
    Route::get('branch-user/stock', 'stock');
    Route::get('branch-user/order', 'orders');
    Route::get('branch-user/order-detail/{id}', 'orderDetail');
    Route::post('request-stock', 'requestStock')->name('request-stock');
    Route::post('update-order', 'updateOrder')->name('update-order');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/home', 'home');
    Route::get('post-detail/{id}', 'postDetail');
    Route::get('/branch', 'branch');
    Route::get('/branch-detail/{id}', 'branchDetail');
    Route::get('/product/{branch_id}/{id}', 'productDetail');
    Route::post('/add-to-card', 'addToCard')->name('add-to-card');
    Route::get('/cards', 'cards');
    Route::get('/remove-item/{id}', 'removeItem');
    Route::post('/checkout', 'checkOut')->name('checkout');
    Route::get('/orders', 'orderList');
    Route::get('order-detail/{id}', 'orderDetail');
    Route::get('/about', 'about');
    Route::post('/comment', 'comment')->name('comment');
});

Route::get('/', function () {
    return view('user.home');
});
Route::get('/order-detail', function () {
    return view('user.order_detail');
});



Route::get('/branch-detail', function () {
    return view('user.branch_detail');
});

Route::get('/shopping-card', function () {
    return view('user.shopping_card');
});