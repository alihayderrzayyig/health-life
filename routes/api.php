<?php

use App\Http\Controllers\api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('test', function () {
//     return Post::all();
// });

// Route::post('test/create', function (Request $request) {
//     $post = Post::create([
//         'title' => $request->title,
//         'body' => $request->body
//     ]);
//     return $post;
// });

// Route::get('test', [PostController::class, 'index']);
// Route::get('test/{post}', [PostController::class, 'show']);
// Route::post('test/create', [PostController::class, 'store']);

Route::get('post/{name}/search', [PostController::class, 'search']);
Route::resource('post', PostController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
