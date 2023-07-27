<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UserRolesController;
use App\Http\Controllers\Admin\UserPermissionsController;
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

Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('about',[PageController::class,'about'])->name('pages.about');
Route::get('archive',[PageController::class,'archive'])->name('pages.archive');
Route::get('contact',[PageController::class,'contact'])->name('pages.contact');

Route::get('blog/{post}',[PostsController::class,'show'])->name('posts.show');
Route::get('categorias/{category}',[CategoryController::class,'show'])->name('categories.show');
Route::get('tags/{tag}',[TagController::class,'show'])->name('tags.show');

/*Route::get('admin',function(){
    return view('admin.dashboard');
});*/
//Route::group(['prefix'=>'admin', 'middleware'=>['auth','verified']], function(){
    //
//Route::prefix('admin')->name('admin.')->middleware(['auth','verified'])->group(function(){
Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware'=>['auth','verified']], function(){
    Route::get('/',[AdminController::class,'index'])->name('dashboard');

    Route::resource('posts',PostController::class)->except(['show']);
    Route::resource('users',UsersController::class);
    Route::put('users/{user}/roles',[UserRolesController::class,'update'])->name('users.roles.update');
    Route::put('users/{user}/permissions',[UserPermissionsController::class,'update'])->name('users.permissions.update');

    /*
    Route::get('posts',[PostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create',[PostController::class, 'create'])->name('admin.posts.create');
    Route::post('posts',[PostController::class, 'store'])->name('admin.posts.store');
    Route::get('posts/{post}',[PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('posts/{post}',[PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('posts/{post}',[PostController::class,'destroy'])->name('admin.posts.destroy');
    */

    Route::post('posts/{post}/photos',[PhotoController::class, 'store'])->name('posts.photos.store');
    Route::delete('photos/{photo}',[PhotoController::class,'destroy'])->name('photos.destroy');
});
    
/*Route::get('/dashboard', function () {
   // return view('dashboard');
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
