<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function(){
Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

Route::resource('users', App\Http\Controllers\UserController::class);
Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

Route::resource('category', CategoryController::class);
});


Route::resource('post', PostController::class);
Route::post('/post/{id}/comment', [PostController::class, 'storeComment'])->name('post.comment.store')->middleware('auth');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');




Route::get('/', [PostController::class, 'index'])->name('post.index');

Route::get('/dashboard', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
