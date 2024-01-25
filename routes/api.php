<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\PodcastController;
use App\Http\Controllers\API\PodcastListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::get('/podcasts',[PodcastController::class,'index']);
    Route::post('/add-podcast',[PodcastController::class,'store']);
    Route::get('/podcast/{podcast}',[PodcastController::class,'show']);
    Route::put('/update-podcast/{podcast}',[PodcastController::class,'update']);
    Route::delete('/delete-podcast/{podcast}',[PodcastController::class,'delete']);

    Route::get('/podcastLists',[PodcastListController::class,'index']);
    Route::post('/add-podcastList',[PodcastListController::class,'store']);
    Route::get('/podcastList/{podcastList}',[PodcastListController::class,'show']);
    Route::put('/update-podcastList/{podcastList}',[PodcastListController::class,'update']);
    Route::delete('/delete-podcastList/{podcastList}',[PodcastListController::class,'delete']);

    Route::get('/jobs',[JobController::class,'index']);
    Route::post('/add-job',[JobController::class,'store']);
    Route::get('/job/{job}',[JobController::class,'show']);
    Route::put('/update-job/{job}',[JobController::class,'update']);
    Route::delete('/delete-job/{job}',[JobController::class,'delete']);

    Route::get('/books',[BookController::class,'index']);
    Route::post('/add-book',[BookController::class,'store']);
    Route::get('/book/{book}',[BookController::class,'show']);
    Route::put('/update-book/{book}',[BookController::class,'update']);
    Route::delete('/delete-book/{book}',[BookController::class,'delete']);
    Route::get('/download-book/{book}',[BookController::class,'download']);
});
