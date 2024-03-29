<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::get('/',[HomeController::class,'index'])->name('root');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//----------------- *** Admin Routes *** ----------------------//
Route::middleware('auth','verified')->group(function(){
    Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');
    //----------------- *** Category Routes *** ----------------------//
    Route::get('/view_category',[AdminController::class,'view_category']);
    Route::post('/add_category',[AdminController::class,'add_category']);
    Route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
    //----------------- *** Product Routes *** ----------------------//
    Route::get('/view_product',[AdminController::class,'view_product']);
    Route::post('/add_product',[AdminController::class,'add_product']);
    Route::get('/show_product',[AdminController::class,'show_product']);
    Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
    Route::get('/update_product/{id}',[AdminController::class,'update_product']);
    Route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);
    //----------------- *** Order Routes *** ----------------------//
    Route::get('/order',[AdminController::class,'order']);
    Route::get('/delivered/{id}',[AdminController::class,'delivered']);
    Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
    Route::get('/send_email/{id}',[AdminController::class,'send_email']);
    Route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);
    //----------------- *** Search Route *** ----------------------//
    Route::get('/search',[AdminController::class,'searchData']);

});
//----------------- *** User Routes *** ----------------------//
Route::get('/product_details/{id}',[HomeController::class,'product_details']);
Route::middleware('auth','verified')->group(function(){

    //------------------------------ *** Cart Routes *** --------------------------------------------//
    Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
    Route::get('/show_cart',[HomeController::class,'show_cart']);
    Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);

    //------------------------------ *** Order Routes *** --------------------------------------------//
    Route::get('/cash_order',[HomeController::class,'cash_order']);
    Route::get('/show_order',[HomeController::class,'show_order']);
    Route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);

    //------------------------------ *** Stripe Routes *** --------------------------------------------//
    Route::get('/stripe/{totalPrice}', [HomeController::class, 'stripe'])->name('stripeForm');
    Route::post('stripe-form/submit', [HomeController::class, 'submit'])->name('stripeSubmit');
    Route::get('stripe-response/{id}', [HomeController::class, 'response'])->name('stripeResponse');
    //<-------------------------------------old stripe route----------------------------->//
    // Route::get('/stripe/{totalPrice}',[HomeController::class,'stripe']);
    // Route::post('stripe/{totalPrice}',[HomeController::class,'stripePost'])->name('stripe.post');
});
