<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RSSFeedController;

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



Route::get('/cache', function () {
    Artisan::call('optimize:clear');
    return "cache Clear";
});


#Frontend Routes
Route::get('/', [AdminController::class, 'index'])->middleware('auth');
Route::get('/about', [FrontendController::class, 'about']);
Route::get('/contact', [FrontendController::class, 'contact']);
Route::get('/members', [FrontendController::class, 'members']);
Route::get('/membership', [FrontendController::class, 'membership']);
Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy']);
Route::get('/terms-and-conditions', [FrontendController::class, 'terms_and_conditions']);
Route::post('/contact/email', [FrontendController::class, 'contactEmail']);


Route::middleware('auth')->group(function () {
    // Route::get('/', [AdminController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


#ADMIN ROUTES
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    #dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/submit-test', [AdminController::class, 'submit_test']);


    #Users
    Route::get('/all-users', [AdminController::class, 'all_users'])->name('admin.all_users');
    Route::get('/delete-user/{id}', [AdminController::class, 'delete_user'])->name('admin.delete_users');
    Route::get('/edit-users/{id}', [AdminController::class, 'edit_user'])->name('admin.edit_user');
    Route::post('/edit_user_action', [AdminController::class, 'edit_user_action'])->name('admin.edit_user_action');
    Route::get('/setting', [AdminController::class, 'setting'])->name('admin.setting');
    Route::post('/setting_action', [AdminController::class, 'setting_action'])->name('admin.setting_action');
    Route::get('/change-password', [AdminController::class, 'change_password'])->name('admin.change_password');
    Route::post('/change_password_action', [AdminController::class, 'change_password_action'])->name('admin.change_password_action');


 

    #Topics
    Route::get('/topics/add', [AdminController::class, 'add_topics'])->name('admin.add_topics');
    Route::post('/topics/add', [AdminController::class, 'add_topics_action'])->name('admin.add_topics_action');
    Route::get('/topics', [AdminController::class, 'topics'])->name('admin.topics');
    Route::get('/topics/edit/{id}', [AdminController::class, 'edit_topics'])->name('admin.edit_topics');
    Route::post('/topics/edit', [AdminController::class, 'edit_topics_action'])->name('admin.edit_topics_action');
    Route::get('/topics/delete/{id}', [AdminController::class, 'delete_topics'])->name('admin.delete_topics');

    #questions

    Route::get('/questions/add', [AdminController::class, 'add_questions'])->name('admin.add_questions');
    Route::post('/add_questions_action', [AdminController::class, 'add_questions_action'])->name('admin.add_questions_action');
    Route::get('/questions/list', [AdminController::class, 'all_questions'])->name('admin.all_questions');
    Route::get('/questions/edit/{id}', [AdminController::class, 'edit_questions'])->name('admin.edit_questions');
    Route::post('/questions/edit', [AdminController::class, 'edit_questions_action'])->name('admin.edit_questions_action');
    Route::get('/questions/delete/{id}', [AdminController::class, 'delete_questions'])->name('admin.delete_questions');

    #Mood
    
    Route::get('/moods', [MoodController::class, 'index']);
    Route::post('/moods', [MoodController::class, 'store']);

    #Meditation

    Route::get('/meditation/add', [AdminController::class, 'add_meditation'])->name('admin.add_meditation');
    Route::post('/meditation/add', [AdminController::class, 'add_meditation_action'])->name('admin.add_meditation_action');
    Route::get('/meditation/list', [AdminController::class, 'meditation'])->name('admin.meditation');
    Route::get('/meditation/step/list/{id}', [AdminController::class, 'meditation_step_list'])->name('admin.meditation_step_list');
    Route::get('/meditation/edit/{id}', [AdminController::class, 'edit_meditation'])->name('admin.edit_meditation');
    Route::post('/meditation/edit', [AdminController::class, 'edit_meditation_action'])->name('admin.edit_meditation_action');
    Route::get('/meditation/step/delete/{id}', [AdminController::class, 'delete_meditation_step'])->name('admin.delete_meditation_step');
    Route::get('/meditation/delete/{id}', [AdminController::class, 'delete_meditation'])->name('admin.delete_meditation');
});



require __DIR__ . '/auth.php';
Route::fallback(function () {
    abort(404);
});
