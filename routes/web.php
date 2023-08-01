<?php

use App\Http\Controllers\ProfileController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\BrandController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Category\CouponController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/logout', [ProfileController::class, 'logout'])->name('user.logout');
});

require __DIR__.'/auth.php';

// Admin Routes
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('admin', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [LoginController::class, 'login']);
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


// admin password reset
Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])->name('admin.password.request');
Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])->name('admin.password.email');
Route::get('admin/reset-password/{token}', [NewPasswordController::class, 'create'])->name('admin.password.reset');
Route::post('admin/reset-password', [NewPasswordController::class, 'store'])->name('admin.password.store');


//Admin Category Route
Route::get('admin/categories', [CategoryController::class, 'category'])->name('categories');
Route::post('admin/store/category', [CategoryController::class, 'storeCategory'])->name('store.category');
Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
Route::get('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
Route::post('category/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');

//Admin Brand
Route::get('admin/brands', [BrandController::class, 'brand'])->name('brands');
Route::post('admin/store/brand', [BrandController::class, 'storeBrand'])->name('store.brand');
Route::get('brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');
Route::get('brand/edit/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
Route::post('brand/update/{id}', [BrandController::class, 'updateBrand'])->name('brand.update');
//Admin Sub Category
Route::get('admin/sub/category', [SubCategoryController::class, 'subCategory'])->name('sub.category');
Route::post('admin/store/subcategory', [SubCategoryController::class, 'storeSubcat'])->name('store.subcategory');
Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'deleteSubcategory'])->name('subcategory.delete');
Route::get('subcategory/edit/{id}', [SubCategoryController::class, 'editSubcategory'])->name('subcategory.edit');
Route::post('subcategory/update/{id}', [SubCategoryController::class, 'updateSubcategory'])->name('subcategory.update');

//Admin Coupon
Route::get('admin/coupon', [CouponController::class, 'Coupon'])->name('admin.coupon');
Route::post('admin/coupon/store', [CouponController::class, 'CouponStore'])->name('store.coupon');

