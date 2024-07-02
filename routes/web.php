<?php

use App\Http\Controllers\Api\Auth\SignInApiController;
use App\Http\Controllers\Api\CampaignApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\MailApiController;
use App\Http\Controllers\Api\TagApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Views\Auth\SignInViewController;
use App\Http\Controllers\Views\Auth\SignOutViewController;
use App\Http\Controllers\Views\CampaignViewController;
use App\Http\Controllers\Views\ClientViewController;
use App\Http\Controllers\Views\HomeViewController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/sign-in', [SignInViewController::class, 'form'])->name('sign-in');
    Route::post('/sign-in', [SignInApiController::class, 'authenticate'])->name('sign-in.authenticate');
    Route::get('/activation/{token}', [SignOutViewController::class, 'activate'])->name('activation');
})->middleware('guest');

Route::middleware('auth:web')->group(function () {
    Route::get('/', [HomeViewController::class, 'index'])->name('static.index');
    Route::get('/home', [HomeViewController::class, 'index'])->name('static.home');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserApiController::class, 'index'])->name('index');
        Route::get('/{username}', [UserApiController::class, 'show'])->name('show');
    });

    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientViewController::class, 'index'])->name('index');
        Route::get('/{id}', [ClientViewController::class, 'show'])->name('show');
        Route::post('/', [ClientApiController::class, 'store'])->name('store');
        Route::put('/{id}', [ClientApiController::class, 'update'])->name('update');
        Route::delete('/{id}', [ClientApiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/', [CampaignViewController::class, 'index'])->name('index');
        Route::get('/{id}', [CampaignViewController::class, 'show'])->name('show');
        Route::post('/', [CampaignApiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CampaignViewController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CampaignApiController::class, 'update'])->name('update');
        Route::delete('/{id}', [CampaignApiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tags')->name('tags.')->group(function () {
        Route::get('/', [TagApiController::class, 'index'])->name('index');
        Route::get('/{slug}', [TagApiController::class, 'show'])->name('show');
        Route::delete('/{slug}', [TagApiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('mails')->name('mails.')->group(function () {
        Route::get('/', [MailApiController::class, 'index'])->name('index');
    });
});
