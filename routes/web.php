<?php

use App\Http\Controllers\Api\Auth\SignInApiController;
use App\Http\Controllers\Api\CampaignApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\MailApiController;
use App\Http\Controllers\Api\TagApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Views\Auth\SignInViewController;
use App\Http\Controllers\Views\Auth\SignUpViewController;
use App\Http\Controllers\Views\CampaignViewController;
use App\Http\Controllers\Views\ClientViewController;
use App\Http\Controllers\Views\HomeViewController;
use App\Http\Controllers\Views\MailViewController;
use App\Http\Controllers\Views\TagViewController;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn () => redirect()->route('auth.sign-in'))->name('login');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/sign-in', [SignInViewController::class, 'form'])->name('sign-in');
    Route::post('/sign-in', [SignInApiController::class, 'authenticate'])->name('authenticate');
    Route::get('/activation/{token}', [SignUpViewController::class, 'activate'])->name('activation');
})->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeViewController::class, 'index'])->name('home');
    Route::get('/home', [HomeViewController::class, 'index'])->name('static.home');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserApiController::class, 'index'])->name('index');
        Route::get('/{username}', [UserApiController::class, 'show'])->name('show');
    });

    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientViewController::class, 'index'])->name('index');
        Route::post('/', [ClientApiController::class, 'store'])->name('store');
        Route::get('/create', [ClientViewController::class, 'create'])->name('create');
        Route::get('/{username}', [ClientViewController::class, 'show'])->name('show');
        Route::get('/{username}/edit', [ClientViewController::class, 'edit'])->name('edit');
        Route::post('/{username}', [ClientApiController::class, 'update'])->name('update');
        Route::delete('/{username}', [ClientApiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/', [CampaignViewController::class, 'index'])->name('index');
        Route::post('/', [CampaignApiController::class, 'store'])->name('store');
        Route::get('/{code}', [CampaignViewController::class, 'show'])->name('show');
        Route::get('/{code}/edit', [CampaignViewController::class, 'edit'])->name('edit');
        Route::put('/{code}', [CampaignApiController::class, 'update'])->name('update');
        Route::delete('/{code}', [CampaignApiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('mails')->name('mails.')->group(function () {
        Route::get('/', [MailViewController::class, 'index'])->name('index');
        Route::post('/', [MailApiController::class, 'store'])->name('store');
        Route::get('/create', [MailViewController::class, 'create'])->name('create');
        Route::get('/{id}', [MailViewController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MailViewController::class, 'edit'])->name('edit');
        Route::post('/{id}', [MailApiController::class, 'update'])->name('update');
        Route::delete('/{id}', [MailApiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tags')->name('tags.')->group(function () {
        Route::get('/', [TagViewController::class, 'index'])->name('index');
        Route::get('/{slug}', [TagApiController::class, 'show'])->name('show');
        Route::delete('/{slug}', [TagApiController::class, 'destroy'])->name('destroy');
    });

});
