<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderUserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
//trang chủ
Route::group(['prefix' => '/'], function (){
    Route::get('', [FrontendController::class, 'getHome'])->name('home');
    // lấy ra chi tiết sản phẩm và comment
    Route::get('/detail/{id}', [FrontendController::class, 'getDetail'])->name('detail');
    Route::post('/detail/{id}', [FrontendController::class, 'postComment'])->middleware('CheckLogedOut')->name('comment');

    // lấy ra các danh mục
    Route::get('/category/{id}', [FrontendController::class, 'getCategory'])->name('category');

    //search
    Route::get('/search', [FrontendController::class, 'getSearch'])->name('search');

});

//Đăng ký
Route::get('/register', [RegisterController::class, 'getRegister'])->middleware('CheckLogedIn');
Route::post('/register', [RegisterController::class, 'postRegister']);

// changepassword
Route::group(['prefix' => 'change-password','middleware' => 'CheckLogedOut'], function (){
    Route::get('/', [PasswordController::class, 'getChangePassword']);
    Route::post('/', [PasswordController::class, 'updatePassword']);
});


// Admin
Route::group(['namespace' => 'Admin'], function () {
    //login
    Route::group(['prefix' => '/login', 'middleware' => 'CheckLogedIn'], function (){
       Route::get('/', [LoginController::class, 'getLogin']);
       Route::post('/', [LoginController::class, 'postLogin']);
    });

    //logout
    Route::get('/logout', [HomeController::class, 'getLogout']);

    //admin
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckUserRole'], function (){

        //admin page
        Route::get('/home', [HomeController::class, 'getHome']);

        //category
        Route::group(['prefix' => 'category'], function (){
            Route::get('/', [CategoryController::class, 'getCategory']);

            Route::post('/', [CategoryController::class, 'postCreateCategory']);

            Route::get('/edit/{id}', [CategoryController::class, 'getEditCategory']);
            Route::post('/edit/{id}', [CategoryController::class, 'putUpdateCategory']);

            Route::get('/delete/{id}', [CategoryController::class, 'getDeleteCategory']);
        });

        //news
        // Thay thế các route cũ liên quan đến product bằng:
        Route::get('news', [NewsController::class, 'getNews'])->name('admin.news');
        Route::get('news/create', [NewsController::class, 'getCreateNews'])->name('admin.news.create');
        Route::post('news/create', [NewsController::class, 'postCreateNews'])->name('admin.news.store');
        Route::get('news/edit/{id}', [NewsController::class, 'getEditNews'])->name('admin.news.edit');
        Route::put('news/edit/{id}', [NewsController::class, 'putUpdateNews'])->name('admin.news.update');
        Route::get('news/delete/{id}', [NewsController::class, 'getDeleteNews'])->name('admin.news.delete');

        //account
        Route::group(['prefix' => 'account'], function (){
            Route::get('/', [AccountController::class, 'getAccount']);
            Route::get('/delete/{id}', [AccountController::class, 'getDeleteAccount']);
        });

        //comment
        Route::group(['prefix' => 'comment'], function (){
            Route::get('/', [CommentController::class, 'getComment']);
            Route::get('/delete/{id}', [CommentController::class, 'getDeleteComment']);
        });

        //revenue
        Route::group(['prefix' => 'revenue'], function (){
            Route::get('/', [RevenueController::class, 'getRevenue']);
        });
    });
});
