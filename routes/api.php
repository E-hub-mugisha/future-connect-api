<?php

use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminTalentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\users\HomeController;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/talents/{id}', [HomeController::class, 'show']);
Route::get('/talent/skills/{id}', [App\Http\Controllers\users\HomeController::class, 'TalentSkillDetails']);
Route::post('/skills/{id}/reviews', [App\Http\Controllers\users\HomeController::class, 'storeReview']);


Route::apiResource('talents', AdminTalentController::class);
Route::put('/talents/{id}/status', [AdminTalentController::class, 'updateStatus']);
Route::put('/talents/{id}/feature', [AdminTalentController::class, 'feature']);

Route::apiResource('users', AdminUserController::class);
Route::apiResource('categories', AdminCategoryController::class);
Route::apiResource('stories', \App\Http\Controllers\Admin\AdminStoryController::class);
Route::apiResource('skills', \App\Http\Controllers\Admin\AdminSkillController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/announcements', [AdminAnnouncementController::class, 'index']);
    Route::post('/admin/announcements', [AdminAnnouncementController::class, 'store']);
    Route::get('/admin/announcements/{id}', [AdminAnnouncementController::class, 'show']);
    Route::put('/admin/announcements/{id}', [AdminAnnouncementController::class, 'update']);
    Route::delete('/admin/announcements/{id}', [AdminAnnouncementController::class, 'destroy']);
});