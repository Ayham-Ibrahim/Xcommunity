<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\PodcastController;
use App\Http\Controllers\API\PodcastListController;
use App\Http\Controllers\API\AdvertismaentController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\ArticleGroupController;
use App\Http\Controllers\API\SocialiteLoginController;
use App\Http\Controllers\API\SupplementController;
use App\Http\Controllers\API\UserInfoController;
use App\Http\Controllers\API\UserInterestController;

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

Route::get('login/{provider}', [SocialiteLoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteLoginController::class, 'handleProviderCallback']);

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

    Route::get('/article_groups', [ArticleGroupController::class, 'index']);
    Route::get('/article_group/{article_group}', [ArticleGroupController::class, 'show']);
    Route::post('/create_article_group', [ArticleGroupController::class, 'store']);
    Route::post('/update_article_group/{article_group}', [ArticleGroupController::class, 'update']);
    Route::delete('/delete_article_group/{article_group}', [ArticleGroupController::class, 'destroy']);
    Route::get('/interest_article_groups', [ArticleGroupController::class, 'intersteArticleGroups']);

    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/article/{article}', [ArticleController::class, 'show']);
    Route::post('/create_article', [ArticleController::class, 'store']);
    Route::post('/update_article/{article}', [ArticleController::class, 'update']);
    Route::delete('/delete_article/{article}', [ArticleController::class, 'destroy']);
    Route::get('/interest_articles', [ArticleController::class, 'intersteArticles']);

    Route::get('/advertismaents', [AdvertismaentController::class, 'index']);
    Route::get('/advertismaent/{advertismaent}', [AdvertismaentController::class, 'show']);
    Route::post('/create_advertismaent', [AdvertismaentController::class, 'store']);
    Route::post('/update_advertismaent/{advertismaent}', [AdvertismaentController::class, 'update']);
    Route::delete('/delete_advertismaent/{advertismaent}', [AdvertismaentController::class, 'destroy']);

    Route::get('/supplements', [SupplementController::class, 'index']);
    Route::get('/supplement/{supplement}', [SupplementController::class, 'show']);
    Route::post('/create_supplement', [SupplementController::class, 'store']);
    Route::post('/update_supplement/{supplement}', [SupplementController::class, 'update']);
    Route::delete('/delete_supplement/{supplement}', [SupplementController::class, 'destroy']);
    Route::get('/interest_supplements', [SupplementController::class, 'intersteSupplements']);

    Route::get('/user_interests/{user}', [UserInterestController::class, 'index']);
    Route::post('/createOrUpdate_interests', [UserInterestController::class, 'createOrUpdate']);

    Route::get('/user_infos', [UserInfoController::class, 'index']);
    Route::get('/user_info/{user_info}', [UserInfoController::class, 'show']);
    Route::post('/create_user_info', [UserInfoController::class, 'store']);
    Route::post('/update_user_info/{user_info}', [UserInfoController::class, 'update']);
    Route::delete('/delete_user_info/{user_info}', [UserInfoController::class, 'destroy']);
});
