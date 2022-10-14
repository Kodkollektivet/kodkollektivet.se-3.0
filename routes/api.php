<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts-read-more', [PostController::class, 'readMore']);

Route::get('/posts-sidebar', function (Request $request) {
    return PostController::getSidebarPosts($request['community'], $request['user_id'], $request['page']);
});

