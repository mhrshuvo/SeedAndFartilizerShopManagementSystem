<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CouponController;
use App\Http\Controllers\Api\v1\DivisionController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\PreLovedController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProductVariationController;
use App\Http\Controllers\Api\v1\UserController;
use App\Models\v1\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')
    ->group(
        function () {

            Route::get('order',[OrderController::class, 'index']);

            //all public routes
            Route::get('division', [DivisionController::class, 'index']);
            Route::get('division/{division}', [DivisionController::class, 'show']);
            Route::get('products', [ProductController::class, 'index'])->name('product.index');
            Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
            Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
            Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');
            Route::get('search',[ProductController::class,'search'])->name('product.search');
            Route::get('color',[ProductVariationController::class,'color'])->name('color');
            //Auth routes
            Route::get('user_check',[AuthController::class,'checkEmailAndPhoneNoExistOrNot'])->name('user.check');
            Route::post('register',[AuthController::class , 'register'])->name('register');
            Route::post('login',[AuthController::class,'login'])->name('customer_login');

            //otp routes
            Route::post('requestOtp',[AuthController::class,'requestOtp'])->name('otp');
            Route::post('loginWithOtp',[AuthController::class,'loginWithOtp'])->name('customer_login_otp');
            Route::post('verifyOtp',[AuthController::class,'verifyOtp']);



            Route::group(['middleware' => ['auth:sanctum']], function () {
                Route::get('logout', [AuthController::class, 'logout'])->name('logout');
                Route::get('my_referral_code',[AuthController::class,'myReferralCode']);
                Route::post('order',[OrderController::class, 'store'])->name('store.order');
                Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
                Route::get('my_orders',[UserController::class,'myOrderHistory']);
                Route::get('my_coupons',[UserController::class,'myCoupons']);
                Route::post('pre_loved',[PreLovedController::class,'store']);
                Route::get('my_pre_loved',[PreLovedController::class,'getMyPrelovedProducts']);
                Route::post('verify_coupon_code',[CouponController::class,'verify'])->name('couponVerify');
            });

        }


    );

