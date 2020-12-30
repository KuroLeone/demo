<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

// $movies =  Movie::with('genres')->get();
Route::post('/create_post','PostController@store')->name('create_post');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/', function(){

	 $users =  User::all();
        
        
         $posts =  Post::with('user')->get();

	 return view('dashboard',compact('users','posts'));
})->name('dashboard');
Route::middleware(['auth:sanctum','verified'])->get('/create_token','PostController@create_token')->name('create_token');
/*	$posts = Post::all();
	$comments = Comment::all();
	$followers = Follower::all();
	$likes = Like::all();
	$users = User::all();
	//echo asset('storage/Image.txt');die;
	//$contents = Storage::get('app/public/Images.txt');
	//echo $contents;
	//$path = $request->file('Images')->store('Images');
	//dd($path);

'PostController@index')->name('dashboard');
	//function () {

	

    return view('dashboard',compact('posts'));
}
	
*/