<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\CheckRole;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::post('/users', [UsersController::class, 'addUser']);

Route::post('/auth/login', [UsersController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum','checkrole:admin']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });


    Route::post("/products", [ProductsController::class, "store"]);
    Route::put("/products/{uuid}", [ProductsController::class, "update"]);
    Route::delete("/products/{id}", [ProductsController::class, "destroy"]);

  
    
});



//
Route::group(['middleware' => ['auth:sanctum','checkrole:admin,customer']], function () {
    // Route::get('/profile', function(Request $request) {
    //     return auth()->user();
    // });


    Route::get("/products/{uuid}", [ProductsController::class, "show"]);
    Route::post('/logout', [UsersController::class, 'logout']);

  
    
});





