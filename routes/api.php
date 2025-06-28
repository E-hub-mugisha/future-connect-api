<?php

use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminTalentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/talents/{id}', [HomeController::class, 'show']);
Route::get('/categories-with-talent-count', [HomeController::class, 'withTalentCount']);
Route::get('/talent/skills/{id}', [App\Http\Controllers\users\HomeController::class, 'TalentSkillDetails']);
Route::get('/talents/category/{slug}', [HomeController::class, 'getTalentByCategory']);
Route::post('/skills/{id}/reviews', [App\Http\Controllers\users\HomeController::class, 'storeReview']);
Route::get('/skills/category/{slug}', [HomeController::class, 'getByCategory']);
Route::get('/skills/{slug}', [HomeController::class, 'skillDetails']);
Route::get('/skills/related/{categoryId}', [HomeController::class, 'relatedSkills']);
Route::get('/story/category/{slug}', [HomeController::class, 'getStoryByCategory']);

Route::get('/story-details/{slug}', [App\Http\Controllers\users\HomeController::class, 'storyDetails']);
Route::get('/testimonials/random', [HomeController::class, 'random']);

Route::post('/stories/comments', [App\Http\Controllers\users\HomeController::class, 'storeStoryComment']);

Route::apiResource('talents', AdminTalentController::class);
Route::put('/talents/{id}/status', [AdminTalentController::class, 'updateStatus']);
Route::put('/talents/{id}/feature', [AdminTalentController::class, 'feature']);

Route::apiResource('users', AdminUserController::class);
Route::apiResource('categories', AdminCategoryController::class);
Route::apiResource('stories', \App\Http\Controllers\Admin\AdminStoryController::class);
Route::apiResource('skills', \App\Http\Controllers\Admin\AdminSkillController::class);


Route::resource('announcements', AdminAnnouncementController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('banners', AdminBannerController::class);
Route::apiResource('testimonials', AdminTestimonialController::class);