<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('home',[\App\Http\Controllers\api\CategoriesController::class,'getHomeCategory']);
Route::post('category',[\App\Http\Controllers\api\CategoriesController::class,'getCategory']);

Route::post('authors',[\App\Http\Controllers\api\AuthorController::class,'getAuthors']);
Route::post('authors/add',[\App\Http\Controllers\api\AuthorController::class,'add']);
Route::post('authors/edit',[\App\Http\Controllers\api\AuthorController::class,'edit']);
Route::post('authors/del',[\App\Http\Controllers\api\AuthorController::class,'del']);
Route::post('authors/avatar',[\App\Http\Controllers\api\AuthorController::class,'getAvatar']);

Route::post('news/getAllNewsAvatar', [\App\Http\Controllers\api\NewsController::class,'getAllNewsAvatar']);
Route::post('authors/news', [\App\Http\Controllers\api\NewsController::class,'getAuthorNews']);
Route::post('category/all', [\App\Http\Controllers\api\CategoriesController::class,'getAllcategory']);
Route::post('category/save', [\App\Http\Controllers\api\CategoriesController::class,'saveCategory']);
