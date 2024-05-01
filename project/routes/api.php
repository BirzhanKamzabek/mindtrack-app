<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\MoodController;

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


#Without Auth
Route::group(['middleware' => 'core'], function () {

    Route::post('/register', [ApiController::class, 'register']);
    Route::post('/login', [ApiController::class, 'login'])->middleware('online');

    Route::post('/send-reset-password-email', [PasswordResetController::class, 'send_reset_password_email']);
    Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset']);

    Route::post('/forgot_password_otp', [ApiController::class, 'forgot_password_otp']);

    Route::post('/user_register', [ApiController::class, 'user_register']);

    Route::post('/login_action', [ApiController::class, 'login_action']);

    Route::get('/all_questions', [ApiController::class, 'all_questions']);

    Route::get('/single_question/{id}', [ApiController::class, 'single_question']);
    Route::get('/topics', [ApiController::class, 'all_topics']);
});

Route::get('/moods', [MoodController::class, 'index']);
Route::post('/moods', [MoodController::class, 'store']);


Route::get('user/is_online', [ApiController::class, 'user_is_online'])->middleware('auth:sanctum');
#user Routes
Route::group(['prefix' => 'user', 'middleware' => ['core', 'auth:sanctum', 'online']], function () {

    Route::get('/logout', [ApiController::class, 'logout']);
    Route::post('/profile/update/{id}', [ApiController::class, 'user_profile_update']);
    Route::get('/all', [ApiController::class, 'get_all_users']);
    Route::get('/me', [ApiController::class, 'login_user']);
    Route::post('/gallery', [ApiController::class, 'user_gallery']);
    Route::post('/gallery/delete/', [ApiController::class, 'delete_user_gallery']);
    Route::post('/view', [ApiController::class, 'user_view']);
    Route::get('/viewed/by', [ApiController::class, 'user_viewed_by']);
    Route::get('/favourite', [ApiController::class, 'user_favourite']);
    Route::post('/favourite', [ApiController::class, 'user_favourite_post']);
    Route::get('/flame', [ApiController::class, 'user_flame']);
    Route::post('/flame', [ApiController::class, 'user_flame_post']);
    // Route::get('/is_online', [ApiController::class, 'user_is_online']);
    Route::get('/filter', [ApiController::class, 'user_filter'])->middleware('subscription');
});

#Common Routes

Route::group(['middleware' => ['core', 'auth:sanctum', 'online']], function () {

    #chats
    Route::get('/me', [ApiController::class, 'me']);
    Route::post('/update_profile', [ApiController::class, 'update_profile']);

    Route::post('/add_test', [ApiController::class, 'add_test']);
    Route::get('/topics/questions/{id}', [ApiController::class, 'topics_questions']);
    Route::get('/test/result/{id}', [ApiController::class, 'test_result']);
    Route::get('/user/tests', [ApiController::class, 'user_tests']);
    #Meditation
    Route::get('/meditation/list', [ApiController::class, 'meditation_list']);
    Route::get('/meditation/list/popular', [ApiController::class, 'meditation_list_popular']);
    Route::get('/meditation/single/{id}', [ApiController::class, 'meditation_single']);
});
