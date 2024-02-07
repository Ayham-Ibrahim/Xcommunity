<?php

use App\Http\Controllers\API\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\PodcastController;
use App\Http\Controllers\API\UserInfoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\SupplementController;
use App\Http\Controllers\API\PodcastListController;
use App\Http\Controllers\API\ArticleGroupController;
use App\Http\Controllers\API\UserInterestController;
use App\Http\Controllers\API\AdvertismaentController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Auth\SocialiteLoginController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\SaveController;

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
// Route::get('/send-mail-verification/{email}', [AuthController::class, 'sendVerifyEmail']);
Route::get('/verify-email/{code}', [AuthController::class, 'emailVerification']);

Route::get('/sendRestEmail', [ResetPasswordController::class, 'sendRestEmail']);
Route::post('/checkTheCode', [ResetPasswordController::class, 'checkTheCode']);
Route::post('/reset', [ResetPasswordController::class, 'reset']);


Route::get('login/{provider}', [SocialiteLoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteLoginController::class, 'handleProviderCallback']);

Route::middleware('auth:sanctum')->group(function () {


    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/changePassword', [ResetPasswordController::class, 'changePassword']);

    #######################################################################################################
    ########################################PODCAST CONTROLLER#############################################
    #######################################################################################################

    Route::get('/podcasts',[PodcastController::class,'index']);
    Route::post('/add-podcast',[PodcastController::class,'store']);
    Route::get('/podcast/{podcast}',[PodcastController::class,'show']);
    Route::put('/update-podcast/{podcast}',[PodcastController::class,'update']);
    Route::delete('/delete-podcast/{podcast}',[PodcastController::class,'delete']);
    Route::get('/savetoArchive/{podcast}',[PodcastController::class,'savetoArchive']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ###################################### PODCAST LIST CONTROLLER ########################################
    #######################################################################################################

    Route::get('/podcastLists',[PodcastListController::class,'index']);
    Route::post('/add-podcastList',[PodcastListController::class,'store']);
    Route::get('/podcastList/{podcastList}',[PodcastListController::class,'show']);
    Route::put('/update-podcastList/{podcastList}',[PodcastListController::class,'update']);
    Route::delete('/delete-podcastList/{podcastList}',[PodcastListController::class,'delete']);
    Route::post('/podcastListRating/{podcastList}',[PodcastListController::class,'podcastListRating']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ########################################## JOB CONTROLLER #############################################
    #######################################################################################################

    Route::get('/jobs',[JobController::class,'index']);
    Route::post('/add-job',[JobController::class,'store']);
    Route::get('/job/{job}',[JobController::class,'show']);
    Route::put('/update-job/{job}',[JobController::class,'update']);
    Route::delete('/delete-job/{job}',[JobController::class,'delete']);
    Route::get('/savetoArchive/{job}',[JobController::class,'savetoArchive']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ######################################## ARTICLE CONTROLLER ###########################################
    #######################################################################################################

    Route::get('/article_groups', [ArticleGroupController::class, 'index']);
    Route::get('/article_group/{article_group}', [ArticleGroupController::class, 'show']);
    Route::post('/create_article_group', [ArticleGroupController::class, 'store']);
    Route::post('/update_article_group/{article_group}', [ArticleGroupController::class, 'update']);
    Route::delete('/delete_article_group/{article_group}', [ArticleGroupController::class, 'destroy']);
    Route::get('/interest_article_groups', [ArticleGroupController::class, 'intersteArticleGroups']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ##################################### ARTICLE GROUP CONTROLLER ########################################
    #######################################################################################################

    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/article/{article}', [ArticleController::class, 'show']);
    Route::post('/create_article', [ArticleController::class, 'store']);
    Route::post('/update_article/{article}', [ArticleController::class, 'update']);
    Route::delete('/delete_article/{article}', [ArticleController::class, 'destroy']);
    Route::get('/interest_articles', [ArticleController::class, 'intersteArticles']);
    Route::get('/savetoArchive/{article}',[ArticleController::class,'savetoArchive']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ##################################### ADVERTISMAENT CONTROLLER ########################################
    #######################################################################################################

    Route::get('/advertismaents', [AdvertismaentController::class, 'index']);
    Route::get('/advertismaent/{advertismaent}', [AdvertismaentController::class, 'show']);
    Route::post('/create_advertismaent', [AdvertismaentController::class, 'store']);
    Route::post('/update_advertismaent/{advertismaent}', [AdvertismaentController::class, 'update']);
    Route::delete('/delete_advertismaent/{advertismaent}', [AdvertismaentController::class, 'destroy']);
    Route::get('/savetoArchive/{advertismaent}',[AdvertismaentController::class,'savetoArchive']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ######################################### STORE CONTROLLER ############################################
    #######################################################################################################

    Route::get('/stores/{type}', [StoreController::class, 'index']);
    Route::get('/store/{store}', [StoreController::class, 'show']);
    Route::post('/create_store', [StoreController::class, 'store']);
    Route::post('/update_store/{store}', [StoreController::class, 'update']);
    Route::delete('/delete_store/{store}', [StoreController::class, 'destroy']);
    Route::get('/interest_stores/{type}', [StoreController::class, 'interstestores']);
    Route::get('/download_store/{store}',[StoreController::class,'download']);
    Route::post('/storeRating/{store}',[StoreController::class,'storetRating']);
    Route::get('/savetoArchive/{store}',[StoreController::class,'savetoArchive']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ##################################### USER INTEREST CONTROLLER ########################################
    #######################################################################################################

    Route::get('/user_interests/{user}', [UserInterestController::class, 'index']);
    Route::post('/createOrUpdate_interests', [UserInterestController::class, 'createOrUpdate']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    #######################################################################################################
    ####################################### USER INFO CONTROLLER ##########################################
    #######################################################################################################

    Route::get('/user_infos', [UserInfoController::class, 'index']);
    Route::get('/user_info/{user_info}', [UserInfoController::class, 'show']);
    Route::post('/create_user_info', [UserInfoController::class, 'store']);
    Route::post('/update_user_info/{user_info}', [UserInfoController::class, 'update']);
    Route::delete('/delete_user_info/{user_info}', [UserInfoController::class, 'destroy']);

    #######################################################################################################
    #######################################################################################################
    #######################################################################################################

    // SEARCH
    Route::get('/serch/{search_param}', [SearchController::class, 'search']);


    // ACTIVITY
    Route::get('/yourActivity', [ActivityController::class, 'yourActivity']);
    Route::delete('/destroyActivity', [ActivityController::class, 'destroyActivity']);

    // likes
    Route::post('/article/{article}/toggle-like', [ArticleController::class, 'toggleLike']);
    Route::post('/podcast/{podcast}/toggle-like', [PodcastController::class, 'toggleLike']);

    // follow
    Route::post('/articleGroup/{articleGroup}/follow-toggle', [ArticleGroupController::class, 'followGroup']);
    Route::post('/podcastList/{podcastList}/follow-toggle', [PodcastListController::class, 'followList']);

    // Show Archive
    Route::get('/showUserArchiveItem' , [SaveController::class, 'showUserArchiveItem']);


    Route::post('/store-token', [NotificationController::class, 'updateDeviceToken']);
    Route::post('/send-web-notification', [NotificationController::class, 'sendNotification']);


});
