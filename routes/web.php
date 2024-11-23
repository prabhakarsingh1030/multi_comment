<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[PostController::class,'index']);
Route::post('/post_store',[PostController::class,'store'])->name('post.store');




// frontend



Route::get('frontend/homepage',[HomeController::class,'index']);
Route::get('frontend/homepageByid/{id}',[HomeController::class,'postById'])->name('homepage.postById');
Route::get('postbyid/{id}',[HomeController::class,'postbyid']);


// comment
Route::post('frontend/homepage/comment',[CommentController::class,'store'])->name('comment.store');
Route::get('frontend/homepag/comment/show/{id}',[CommentController::class,'show'])->name('comment.show');



// reply



Route::post('replyStore',[CommentController::class,'replyStore'])->name('reply.store');