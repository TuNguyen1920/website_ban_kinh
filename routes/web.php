<?php

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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('errors-403', function() {
    return view('errors.403');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/login', 'LoginController@login')->name('admin.login');
        Route::post('/login', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@getRegister')->name('admin.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('admin.forgot.password');
    });

    Route::group(['middleware' =>['web']], function() {
        Route::get('/home', 'HomeController@index')->name('admin.home')->middleware('permission:truy-cap-he-thong|quan-tri-website');

        Route::group(['prefix' => 'group-permission'], function(){
            Route::get('/','GroupPermissionController@index')->name('group.permission.index');
            Route::get('/create','GroupPermissionController@create')->name('group.permission.create');
            Route::post('/create','GroupPermissionController@store');

            Route::get('/update/{id}','GroupPermissionController@edit')->name('group.permission.update');
            Route::post('/update/{id}','GroupPermissionController@update');

            Route::get('/delete/{id}','GroupPermissionController@destroy')->name('group.permission.delete');
        });

        Route::group(['prefix' => 'permission'], function(){
            Route::get('/','PermissionController@index')->name('permission.index');
            Route::get('/create','PermissionController@create')->name('permission.create');
            Route::post('/create','PermissionController@store');

            Route::get('/update/{id}','PermissionController@edit')->name('permission.update');
            Route::post('/update/{id}','PermissionController@update');

            Route::get('/delete/{id}','PermissionController@delete')->name('permission.delete');
        });

        Route::group(['prefix' => 'role'], function(){
            Route::get('/','RoleController@index')->name('role.index')->middleware('permission:danh-sach-vai-tro|quan-tri-website');
            Route::get('/create','RoleController@create')->name('role.create')->middleware('permission:them-moi-vai-tro|quan-tri-website');
            Route::post('/create','RoleController@store');

            Route::get('/update/{id}','RoleController@edit')->name('role.update')->middleware('permission:chinh-sua-vai-tro|quan-tri-website');
            Route::post('/update/{id}','RoleController@update');

            Route::get('/delete/{id}','RoleController@delete')->name('role.delete')->middleware('permission:xoa-vai-tro|quan-tri-website');
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/','UserController@index')->name('user.index')->middleware('permission:danh-sach-nguoi-dung|quan-tri-website');
            Route::get('/create','UserController@create')->name('user.create')->middleware('permission:them-moi-nguoi-dung|quan-tri-website');
            Route::post('/create','UserController@store');

            Route::get('/update/{id}','UserController@edit')->name('user.update')->middleware('permission:chinh-sua-nguoi-dung|quan-tri-website');
            Route::post('/update/{id}','UserController@update');

            Route::get('/delete/{id}','UserController@delete')->name('user.delete')->middleware('permission:xoa-nguoi-dung|quan-tri-website');
        });

        Route::group(['prefix' => 'category'], function(){
            Route::get('/','CategoryController@index')->name('category.index')->middleware('permission:danh-sach-danh-muc|quan-tri-website');
            Route::get('/create','CategoryController@create')->name('category.create')->middleware('permission:them-moi-danh-muc|quan-tri-website');
            Route::post('/create','CategoryController@store');

            Route::get('/update/{id}','CategoryController@edit')->name('category.update')->middleware('permission:chinh-sua-danh-muc|quan-tri-website');
            Route::post('/update/{id}','CategoryController@update');

            Route::get('/delete/{id}','CategoryController@delete')->name('category.delete')->middleware('permission:xoa-danh-muc|quan-tri-website');
        });

        Route::group(['prefix' => 'trademark'], function(){
            Route::get('/','TrademarkController@index')->name('trademark.index')->middleware('permission:danh-sach-thuong-hieu|quan-tri-website');
            Route::get('/create','TrademarkController@create')->name('trademark.create')->middleware('permission:them-moi-thuong-hieu|quan-tri-website');
            Route::post('/create','TrademarkController@store');

            Route::get('/update/{id}','TrademarkController@edit')->name('trademark.update')->middleware('permission:chinh-sua-thuong-hieu|quan-tri-website');
            Route::post('/update/{id}','TrademarkController@update');

            Route::get('/delete/{id}','TrademarkController@delete')->name('trademark.delete')->middleware('permission:xoa-thuong-hieu|quan-tri-website');
        });

        Route::group(['prefix' => 'attribute'], function(){
            Route::get('/','AttributeController@index')->name('attribute.index')->middleware('permission:danh-sach-thuoc-tinh|quan-tri-website');
            Route::get('/create','AttributeController@create')->name('attribute.create')->middleware('permission:them-moi-thuoc-tinh|quan-tri-website');
            Route::post('/create','AttributeController@store');

            Route::get('/update/{id}','AttributeController@edit')->name('attribute.update')->middleware('permission:chinh-sua-thuoc-tinh|quan-tri-website');
            Route::post('/update/{id}','AttributeController@update');

            Route::get('/delete/{id}','AttributeController@delete')->name('attribute.delete')->middleware('permission:xoa-thuoc-tinh|quan-tri-website');
        });
        Route::group(['prefix' => 'value'], function(){
            Route::get('/','ValueController@index')->name('value.index')->middleware('permission:danh-sach-gia-tri|quan-tri-website');
            Route::get('/create','ValueController@create')->name('value.create')->middleware('permission:them-moi-gia-tri|quan-tri-website');
            Route::post('/create','ValueController@store');

            Route::get('/update/{id}','ValueController@edit')->name('value.update')->middleware('permission:chinh-sua-gia-tri|quan-tri-website');
            Route::post('/update/{id}','ValueController@update');

            Route::get('/delete/{id}','ValueController@delete')->name('value.delete')->middleware('permission:xoa-gia-tri|quan-tri-website');
        });

        Route::group(['prefix' => 'product'], function(){
            Route::get('/','ProductController@index')->name('product.index')->middleware('permission:danh-sach-san-pham|quan-tri-website');
            Route::get('/create','ProductController@create')->name('product.create')->middleware('permission:them-moi-san-pham|quan-tri-website');
            Route::post('/create','ProductController@store');

            Route::get('/update/{id}','ProductController@edit')->name('product.update')->middleware('permission:chinh-sua-san-pham|quan-tri-website');
            Route::post('/update/{id}','ProductController@update');

            Route::get('/delete/{id}','ProductController@delete')->name('product.delete')->middleware('permission:xoa-san-pham|quan-tri-website');
        });

        Route::group(['prefix' => 'article'], function(){
            Route::get('/','ArticleContrller@index')->name('article.index')->middleware('permission:danh-sach-bai-viet|quan-tri-website');
            Route::get('/create','ArticleContrller@create')->name('article.create')->middleware('permission:them-moi-bai-viet|quan-tri-website');
            Route::post('/create','ArticleContrller@store');

            Route::get('/update/{id}','ArticleContrller@edit')->name('article.update')->middleware('permission:chinh-sua-bai-viet|quan-tri-website');
            Route::post('/update/{id}','ArticleContrller@update');

            Route::get('/delete/{id}','ArticleContrller@delete')->name('article.delete')->middleware('permission:xoa-bai-viet|quan-tri-website');
        });

        Route::group(['prefix' => 'slide'], function(){
            Route::get('/','SlideController@index')->name('slide.index')->middleware('permission:danh-sach-banner|quan-tri-website');
            Route::get('/create','SlideController@create')->name('slide.create')->middleware('permission:them-moi-banner|quan-tri-website');
            Route::post('/create','SlideController@store');

            Route::get('/update/{id}','SlideController@edit')->name('slide.update')->middleware('permission:chinh-sua-banner|quan-tri-website');
            Route::post('/update/{id}','SlideController@update');

            Route::get('/delete/{id}','SlideController@delete')->name('slide.delete')->middleware('permission:xoa-banner|quan-tri-website');
        });

        Route::group(['prefix' => 'event'], function(){
            Route::get('/','EventController@index')->name('event.index')->middleware('permission:danh-sach-su-kien|quan-tri-website');
            Route::get('/create','EventController@create')->name('event.create')->middleware('permission:them-moi-su-kien|quan-tri-website');
            Route::post('/create','EventController@store');

            Route::get('/update/{id}','EventController@edit')->name('event.update')->middleware('permission:chinh-sua-su-kien|quan-tri-website');
            Route::post('/update/{id}','EventController@update');

            Route::get('/delete/{id}','EventController@delete')->name('event.delete')->middleware('permission:xoa-su-kien|quan-tri-website');
        });
        Route::group(['prefix' => 'transactions'], function(){
            Route::get('/', 'TransactionController@index')->name('transaction.index')->middleware('permission:danh-sach-giao-dich|quan-tri-website');
            Route::get('/invoice/print/{id}', 'TransactionController@invoicePrint')->name('transaction.invoice.print')->middleware('permission:chi-tiet-giao-dich|quan-tri-website');
            Route::get('/update/status/{status}/{id}', 'TransactionController@updateStatus')->name('transaction.update.status')->middleware('permission:cap-nhat-trang-thai|quan-tri-website');
            Route::get('delete/{id}', 'TransactionController@delete')->name('transaction.delete')->middleware('permission:xoa-giao-dich|quan-tri-website');
        });
    });
});

Route::group(['namespace' => 'Page'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/user/account', 'LoginController@login')->name('page.user.account');
        Route::post('/account/login', 'LoginController@postLogin')->name('account.login');
        Route::post('/register/account', 'RegisterController@postRegister')->name('account.register');
        Route::get('/logout', 'LoginController@logout')->name('page.user.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('page.user.forgot.password');
    });

    Route::group(['middleware' =>['users']], function() {
        Route::get('thong-tin-tai-khoan.html', 'AccountController@infoAccount')->name('info.account');
        Route::get('danh-sach-giao-dich.html', 'AccountController@transactionUser')->name('users.transactions');
        Route::post('/update/info/account', 'AccountController@updateInfoAccount')->name('update.info.account');
        Route::get('thay-doi-mat-khau', 'AccountController@changePassword')->name('change.password');
        Route::post('change/password', 'AccountController@postChangePassword')->name('post.change.password');
        Route::post('cancel/order/{id}', 'AccountController@cancelOrder')->name('post.cancel.order');
        Route::get('/san-pham-da-xem.html', 'AccountController@watched')->name('page.watched');
    });

    Route::get('/', 'HomeController@index')->name('page.home');
    Route::get('/lien-he.html', 'HomeController@contact')->name('page.contact');
    Route::get('/gioi-thieu.html', 'HomeController@about')->name('page.about');
    Route::get('/tin-tuc.html', 'NewControllers@index')->name('page.news');
    Route::get('chi-tiet/{id}/{slug}.html', 'NewControllers@detail')->name('page.news.detail');
    Route::get('/danh-muc/{id}/{slug}.html', 'CategoryController@index')->name('page.category.index');
    Route::get('/san-pham-moi.html', 'ProductController@index')->name('page.product');
    Route::get('/khuyen-mai.html', 'ProductController@productSale')->name('page.product.sale');
    Route::get('san-pham/{id}/{slug}.html', 'ProductController@detail')->name('product.detail');
    Route::get('gio-hang.html', 'ShoppingCartController@viewCart')->name('view.cart');
    Route::get('thanh-toan.html', 'ShoppingCartController@payment')->name('cart.payment');
    Route::post('add/product/cart', 'ShoppingCartController@addCart')->name('add.product.cart');
    Route::post('update/product/cart/{cartId}/{productId}', 'ShoppingCartController@updateCart')->name('update.product.cart');
    Route::post('delete/product/cart/{id}', 'ShoppingCartController@deleteProductCart')->name('delete.product.cart');
    Route::post('quick/view/cart', 'ShoppingCartController@quickViewCart')->name('quick.view.cart');
    Route::post('/load/data','LocationController@loadData')->name('ajax.post.load.location');
    Route::post('/post/payment','ShoppingCartController@postPayment')->name('post.payment');
    Route::post('payment/online','ShoppingCartController@createPayment')->name('payment.online');
    Route::get('vnpay/return', 'ShoppingCartController@vnpayReturn')->name('vnpay.return');
    Route::get('/chinh-sach-van-chuyen.html', 'HomeController@transport')->name('page.transport');
    Route::get('/chinh-sach-doi-tra.html', 'HomeController@changeReturn')->name('page.change.return');
    Route::get('/chinh-sach-bao-mat.html', 'HomeController@security')->name('page.security');
    Route::get('/tin-tuc/{id}/{slug}.html', 'CategoryController@listCategoryNew')->name('page.list.new');
    Route::post('/load/viewed/products', 'ProductController@loadViewedProducts')->name('load.viewed.products');
    Route::post('/get/price/product/{id}', 'ProductController@priceProduct')->name('get.price.product');

});

