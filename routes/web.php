<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllergenController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Models\Menu;

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
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/edit/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');


Route::get('/allergen', [AllergenController::class, 'index'])->name('allergen.index');
Route::get('/allergen/create', [AllergenController::class, 'create'])->name('allergen.create');
Route::post('/allergen/create', [AllergenController::class, 'store'])->name('allergen.store');
Route::get('/allergen/edit/{allergen}', [AllergenController::class, 'edit'])->name('allergen.edit');
Route::post('/allergen/edit/{allergen}', [AllergenController::class, 'update'])->name('allergen.update');
Route::get('/allergen/delete/{allergen}', [AllergenController::class, 'destroy'])->name('allergen.destroy');
Route::get('/allergen/{allergen}', [AllergenController::class, 'show'])->name('allergen.show');

Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
Route::post('/restaurant/create', [RestaurantController::class, 'store'])->name('restaurant.store');
Route::get('/restaurant/edit/{restaurant}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::post('/restaurant/edit/{restaurant}', [RestaurantController::class, 'update'])->name('restaurant.update');
Route::get('/restaurant/delete/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');

Route::get('/restaurant/{restaurant}/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/restaurant/menu/{menu}', [MenuController::class, 'show'])->name('menus.show');
Route::get('/restaurant/{restaurant}/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('/restaurant/{restaurant}/menus/create', [MenuController::class, 'store'])->name('menus.store');
Route::get('/restaurant/{restaurant}/menus/edit/{menu}', [MenuController::class, 'edit'])->name('menus.edit');
Route::post('/restaurant/{restaurant}/menus/edit/{menu}', [MenuController::class, 'update'])->name('menus.update');
Route::get('/restaurant/menus/delete/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/categories/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::post('/categories/{menu}/save', [CategoryController::class, 'save'])->name('category.save');

Route::get('/restaurant/{menu}/{category}/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/restaurant/{menu}/{category}/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
Route::get('/restaurant/{menu}/{category}/product/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{menu}/{category}/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/qr', [QrController::class, 'index'])->name('qr.index');
Route::get('/qr/download/{qr}', [QrController::class, 'downloadQR'])->name('qr.download');

Route::get('/guest/{id}/index', [GuestController::class, 'index'])->name('guest.index');
Route::get('/guest/{menu}/{category}/products/', [GuestController::class, 'products'])->name('guest.products');

Route::get('/guest/{id}/addFavorite', [FavoriteController::class, 'store'])->name('guest.addFavorite');
Route::get('/guest/favorites', [FavoriteController::class, 'index'])->name('guest.favorites');
Route::get('/guest/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/guest/{menu}/about', [GuestController::class, 'about'])->name('guest.about');

Route::get('/guest/product', function () {
    return view('/guest/product');
})->name('guest.product');


require __DIR__ . '/auth.php';


Route::get('/download/{menu}', function (Menu $menu) {;
    header('Pragma: public');     // required
    header('Expires: 0');        // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    // header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($menu->qr)) . ' GMT');
    header('Cache-Control: private', false);
    // header('Content-Type: ' . $mime);
    header('Content-Disposition: attachment; filename="' . basename($menu->qr) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Connection: close');
    readfile($menu->qr);        // push it out
    exit();
})->name('download');
