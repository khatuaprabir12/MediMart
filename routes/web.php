<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

//Admin

Route::get('/admin',[AdminController::class,'index'])->name('admin');

Route::get('/adminproducts',[AdminController::class,'products'])->name('products');
// Route::get('/viewproduct', [AdminController::class, 'view_product']);
Route::post('/addproduct', [AdminController::class, 'add_product']);
// Route::post('/editproduct', [AdminController::class, 'edit_product']);

Route::post('/editproduct/{id}', [AdminController::class, 'edit_product'])->name('editproduct');
Route::delete('/deleteproduct/{id}', [AdminController::class, 'delete_product'])->name('deleteproduct');

//view user
Route::get('/customerview', [AdminController::class, 'customer_view'])->name('customer.index');
Route::get('/admin/customers/block/{id}', [AdminController::class, 'blockCustomer'])->name('customer.block');
Route::get('/admin/customers/unblock/{id}', [AdminController::class, 'unblockCustomer'])->name('customer.unblock');
Route::get('/admin/customers/delete/{id}', [AdminController::class, 'deleteCustomer'])->name('customer.delete');



// Route::get('/adminusers',[AdminController::class,'admin_users']);
//order view
// Route::get('/admin/orders/{orderId}', [AdminController::class, 'orderDetails'])->name('admin.order_details');
Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.orders.show');
Route::get('/admin/orders/{id}', [AdminController::class, 'viewOrderDetails'])->name('admin.orders.details');

//admin profile view
Route::get('/adminprofile',[AdminController::class,'admin_profile'])->name('adminprofile');
//admin profile update
Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');














//Customer
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/home',[MainController::class,'index'])->name('home');
// register
Route::get('/register',[MainController::class,'register'])->name('register');
Route::post('/signup',[MainController::class,'data_submit'])->name('data_register');
//Update
Route::post('/update',[MainController::class,'data_update'])->name('updateProfile');
//change password
Route::post('/changepassSubmit', [MainController::class, 'changepass_submit'])->name('changepass.submit');


//login
Route::get('/login',[MainController::class,'login'])->name('login');
Route::post('/submit',[MainController::class,'data_login'])->name('data_login');
//logout
Route::get('/logout', [MainController::class, 'logout'])->name('logout');


//add to cart
Route::get('/cart/{product_id}', [MainController::class, 'addToCart'])->name('mycart');
Route::get('/cart', [MainController::class, 'viewCart'])->name('view.cart');
Route::delete('/cart/{product_id}', [MainController::class, 'removeFromCart'])->name('remove.from.cart');//remove
Route::post('/cart/update-quantity', [MainController::class, 'updateQuantity'])->name('cart.update.quantity');



//checkout summery
// Route::get('/checkout', [MainController::class, 'showCheckout'])->name('checkout');
// Route::post('/checkout', [MainController::class, 'processCheckout'])->name('checkout.process');
Route::post('/checkout', [MainController::class, 'processCheckout'])->name('checkout.process');




//store
// Route::get('/store',[MainController::class,'store'])->name('store');
// Product listing
Route::get('/store', [MainController::class, 'store'])->name('store');

// Filter by category
Route::get('/products/category/{id}', [MainController::class, 'filterByCategory'])->name('products.filter');

//profile
Route::get('/profile',[MainController::class,'profile_display'])->name('profile');

// Route::get('/view_profile/{user_data}',[MainController::class,'view_profile']);

// search result
Route::get('/search', [MainController::class, 'search'])->name('search');



