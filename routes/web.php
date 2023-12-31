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
use App\Http\Controllers\Admin\Category\NewslaterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ReturnOrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleController;



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


// Sosalite Route
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/logout', [ProfileController::class, 'logout'])->name('user.logout');
    Route::get('/password-change', [ProfileController::class, 'passwordChange'])->name('password.change');
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
Route::get('admin/coupon/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
Route::get('admin/coupon/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
Route::post('admin/coupon/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');

//Admin Newslaters
Route::get('admin/newslater', [NewslaterController::class, 'Newslater'])->name('admin.newslater');
Route::get('admin/subscriber/delete/{id}', [NewslaterController::class, 'deleteSubscriber'])->name('subscriber.delete');
Route::post('admin/delete-subscribers', [NewslaterController::class, 'deleteSubscribers'])->name('delete.subscribers');
// Frontend Newslaters
Route::post('store/newslater', [NewslaterController::class, 'storeNewslater'])->name('store.newslater');


//Admin Product Route
Route::get('admin/product/all', [ProductController::class, 'index'])->name('all.product');
Route::get('admin/product/add', [ProductController::class, 'create'])->name('add.product');
Route::post('admin/product/store', [ProductController::class, 'storeProduct'])->name('store.product');

Route::get('admin/product/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('inactive.product');
Route::get('admin/product/active/{id}', [ProductController::class, 'activeProduct'])->name('active.product');
Route::get('admin/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
Route::get('admin/product/view/{id}', [ProductController::class, 'viewProduct'])->name('view.product');
Route::get('admin/product/edit/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
Route::post('admin/product/update/{id}', [ProductController::class, 'updateProduct'])->name('update.product');
Route::post('admin/productimage/update/{id}', [ProductController::class, 'updateProductimage'])->name('update.productimage');

// Sub Category Show by ajax
Route::get('get/subcategory/{category_id}', [ProductController::class, 'GetSubcat']);

// Admin Blog All Route
Route::get('blog/category/list', [PostController::class, 'AddBlogCat'])->name('add.blog.category');
Route::post('blog/category/store', [PostController::class, 'StoreBlogCat'])->name('store.blog.category');
Route::get('blog/category/delete/{id}', [PostController::class, 'DeleteBlogCat'])->name('delete.blog.category');
Route::get('blog/category/edit/{id}', [PostController::class, 'EditBlogCat'])->name('edit.blog.category');
Route::post('blog/category/update/{id}', [PostController::class, 'UpdateBlogCat'])->name('update.blog.category');

Route::get('blog/list', [PostController::class, 'BlogList'])->name('all.blog');
Route::get('blog/add', [PostController::class, 'AddBlog'])->name('add.blog');
Route::post('blog/store', [PostController::class, 'StoreBlog'])->name('store.blog');
Route::get('blog/delete/{id}', [PostController::class, 'DeleteBlog'])->name('delete.blog');
Route::get('blog/edit/{id}', [PostController::class, 'EditBlog'])->name('edit.blog');

Route::post('blog/update/{id}', [PostController::class, 'UpdateBlog'])->name('update.blog');


// Wishlist  All Route
Route::get('wishlist/add/{id}', [WishlistController::class, 'addWishlist']);
Route::get('user/wishlist', [WishlistController::class, 'UserWishlist'])->name('user.wishlist');
Route::get('wishlist/remove/{id}', [WishlistController::class, 'RemoveWishlist']);


//  Cart Route
Route::get('add/to/cart/{id}', [CartController::class, 'AddToCart']);
Route::get('check', [CartController::class, 'check']);
Route::get('product/cart', [CartController::class, 'ShowCart'])->name('show.cart');
Route::get('cart/remove/{id}', [CartController::class, 'RemoveCart'])->name('cart.remove');
Route::post('update/cartqty', [CartController::class, 'UpdateCartQty'])->name('update.cartqty');

Route::get('product/quick/view/{id}', [CartController::class, 'QuickView']);
Route::post('add/quickviewproduct/cart', [CartController::class, 'AddQuickViewProduct'])->name('insert.into.cart');


// Product Details Route
Route::get('product/details/{id}/{product_name}', [ProductDetailsController::class, 'ProductDetsilsView']);
Route::post('cart/product/add/{id}', [ProductDetailsController::class, 'AddCart'])->name('cart.product.add');

// Checkout
Route::get('user/checkout', [CheckoutController::class, 'Checkout'])->name('user.checkout');

// Coupon
Route::post('user/coupon/apply', [CheckoutController::class, 'ApplyCoupon'])->name('apply.coupon');
Route::get('user/coupon/remove', [CheckoutController::class, 'RemoveCoupon'])->name('coupon.remove');

// Blog All route
Route::get('blog/post', [BlogController::class, 'Blog'])->name('blog.post');
Route::get('language/english', [BlogController::class, 'BlogEnglish'])->name('language.english');
Route::get('language/hindi', [BlogController::class, 'BlogHindi'])->name('language.hindi');
Route::get('blog/single/{id}', [BlogController::class, 'BlogSingle'])->name('blog.single');

// Payment All Route
Route::get('payment/page', [PaymentController::class, 'PaymentPage'])->name('payment.step');
Route::post('payment/process', [PaymentController::class, 'payment'])->name('payment.process');

// Product Page

Route::get('products/{id}', [ProductController::class, 'ProductsView'])->name('products.page');
Route::get('allcategory/{id}', [ProductController::class, 'Allcategory'])->name('allcategory');
Route::get('all/products', [ProductController::class, 'allProducts'])->name('all.products');



Route::get('brand/product/{id}', [ProductController::class, 'ProductByBrand'])->name('brand.product');

// Admin Order Route
Route::get('admin/panding/order', [OrderController::class, 'adminNewOrder'])->name('admin.neworder');
Route::get('admin/view/order/{id}', [OrderController::class, 'viewOrder'])->name('admin.view.order');
Route::get('admin/payment/accept/{id}', [OrderController::class, 'paymentAccept'])->name('admin.payment.accept');
Route::get('admin/order/cancle/{id}', [OrderController::class, 'orderCancle'])->name('admin.order.cancle');

Route::get('admin/accept/payment', [OrderController::class, 'paymentAcceptOrders'])->name('admin.accept.payment');
Route::get('admin/processing/orders', [OrderController::class, 'processingOrders'])->name('admin.processing.orders');
Route::get('admin/dalivered/orders', [OrderController::class, 'daliveredOrders'])->name('admin.dalivered.orders');
Route::get('admin/cancle/orders', [OrderController::class, 'cancleOrders'])->name('admin.cancle.orders');

Route::get('admin/delevery/process/{id}', [OrderController::class, 'deleveryProcess'])->name('admin.delevery.process');
Route::get('admin/delevery/done/{id}', [OrderController::class, 'deleveryDone'])->name('admin.delevery.done');


// Profile Dashboard
Route::get('admin/delevery/done/{id}', [OrderController::class, 'deleveryDone'])->name('admin.delevery.done');

Route::get('user/view/order/{id}', [OrderController::class, 'userViewOrder'])->name('user.view.order');

// Admin Seo
Route::get('admin/seo', [SeoController::class, 'getSeo'])->name('admin.seo');
Route::post('admin/seo/update', [SeoController::class, 'updateSeo'])->name('update.seo');

// Order tracking
Route::get('tracking/page', [OrderTrackingController::class, 'getTracking'])->name('tracking');
Route::post('order/tracking', [OrderTrackingController::class, 'orderTracking'])->name('order.tracking');

// Report

Route::get('admin/today/order', [ReportController::class, 'todayOrder'])->name('today.order');
Route::get('admin/today/delivery', [ReportController::class, 'todayDelivery'])->name('today.delivery');
Route::get('admin/this/month', [ReportController::class, 'thisMonth'])->name('this.month');
Route::get('admin/search/report', [ReportController::class, 'searchReport'])->name('search.report');
Route::post('admin/search/by/year', [ReportController::class, 'searchByYear'])->name('search.by.year');
Route::post('admin/search/by/month', [ReportController::class, 'searchBymonth'])->name('search.by.month');
Route::post('admin/search/by/date', [ReportController::class, 'searchByDate'])->name('search.by.date');


// Admin Role Route
Route::get('admin/all/user', [UserRoleController::class, 'userRole'])->name('admin.all.user');
Route::get('admin/create', [UserRoleController::class, 'createAdmin'])->name('create.admin');
Route::post('admin/store', [UserRoleController::class, 'storeAdmin'])->name('store.admin');
Route::get('admin/delete/{id}', [UserRoleController::class, 'deleteAdmin'])->name('delete.admin');
Route::get('admin/edit/{id}', [UserRoleController::class, 'editAdmin'])->name('edit.admin');
Route::post('admin/update', [UserRoleController::class, 'updateAdmin'])->name('update.admin');


// Site Settings
Route::get('admin/site/setting', [SettingController::class, 'siteSetting'])->name('admin.site.setting');
Route::post('admin/update/site/setting', [SettingController::class, 'updateSiteSetting'])->name('update.site.setting');

Route::get('admin/footer/links', [SettingController::class, 'footerLinks'])->name('footer.links');
Route::post('admin/footer/links/store', [SettingController::class, 'footerLinksStore'])->name('footer.links.store');
Route::get('admin/footer/links/edit/{id}', [SettingController::class, 'footerLinksEdit'])->name('links.edit');
Route::post('admin/footer/links/update', [SettingController::class, 'footerLinksUpdate'])->name('update.flinks');
Route::get('admin/footer/links/delete/{id}', [SettingController::class, 'footerLinksDelete'])->name('links.delete');



// Return Order List
Route::get('success/list', [ReturnOrderController::class, 'successOrderList'])->name('success.orderlist');
Route::get('return/request/{id}', [ReturnOrderController::class, 'returnRequest'])->name('return.request');
Route::get('/admin/return/request', [ReturnOrderController::class, 'adminReturnRequest'])->name('admin.return.request');
Route::get('/admin/return/approve/{id}', [ReturnOrderController::class, 'adminReturnApprove'])->name('admin.return.approve');
Route::get('/admin/all/return', [ReturnOrderController::class, 'adminAllReturn'])->name('admin.all.return');

// Order stock route
Route::get('admin/product/stock', [UserRoleController::class, 'productStock'])->name('admin.product.stock');

// Contact Page Route
Route::get('contact/page', [ContactController::class, 'contact'])->name('contact.page');
Route::post('contact/form', [ContactController::class, 'contactForm'])->name('contact.form');
Route::get('admin/all/message', [ContactController::class, 'allMessage'])->name('all.message');
Route::get('admin/view/message/{id}', [ContactController::class, 'ViewMessage'])->name('admin.view.message');

// Search Route
Route::post('product/search', [CartController::class, 'search'])->name('product.search');


