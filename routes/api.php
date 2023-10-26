<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PictureController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\FrameController;
use App\Http\Controllers\API\CustomizedArtController;
use App\Http\Controllers\API\UserController;

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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->get('pictures', [PictureController::class, 'getAllPictures']);
Route::middleware('auth:api')->post('addPicture', [PictureController::class, 'addPicture']);
Route::middleware('auth:api')->get('/picture/{id}', [PictureController::class, 'getPictureById']);
Route::middleware('auth:api')->get('pictureTypes', [PictureController::class, 'getPictureTypes']);
Route::middleware('auth:api')->delete('/pictures/{id}', [PictureController::class, 'deletePicture']);
Route::middleware('auth:api')->put('/pictures/{id}', [PictureController::class, 'updatePicture']);

Route::middleware('auth:api')->get('frames', [FrameController::class, 'getAllFrames']);
Route::middleware('auth:api')->post('addFrame', [FrameController::class, 'addFrame']);
Route::middleware('auth:api')->get('/frame/{id}', [FrameController::class, 'getFrameById']);
Route::middleware('auth:api')->get('frameTypes', [FrameController::class, 'getFrameTypes']);
Route::middleware('auth:api')->delete('/frames/{id}', [FrameController::class, 'deleteFrame']);
Route::middleware('auth:api')->put('/frames/{id}', [FrameController::class, 'updateFrame']);

Route::middleware('auth:api')->get('orders', [OrderController::class, 'getAllOrders']);
Route::middleware('auth:api')->post('addOrder', [OrderController::class, 'addOrder']);
Route::middleware('auth:api')->get('/order/{id}', [OrderController::class, 'getOrderById']);
Route::middleware('auth:api')->delete('/orders/{id}', [OrderController::class, 'deleteOrder']);
Route::middleware('auth:api')->put('/orders/{id}', [OrderController::class, 'updateOrder']);

Route::middleware('auth:api')->get('customizedArt', [CustomizedArtController::class, 'getAllcustomizedArt']);
Route::middleware('auth:api')->post('addCustomizedArt', [CustomizedArtController::class, 'addCustomizedArt']);
Route::middleware('auth:api')->delete('/customizedArt/{id}', [CustomizedArtController::class, 'deleteCustomizedArt']);
Route::middleware('auth:api')->put('/customizedArt/{id}', [CustomizedArtController::class, 'updateCustomizedArt']);

Route::middleware('auth:api')->post('addFeedback', [UserController::class, 'addFeedback']);
Route::middleware('auth:api')->get('feedbacks', [UserController::class, 'getFeedbacks']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


