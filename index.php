<?php

// Show Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION))
    session_start();

require __DIR__ . '/database.php';
require __DIR__ . '/model.php';
require __DIR__ . '/controller.php';
require __DIR__ . '/route.php';
require __DIR__ . '/utils.php';

Route::run('/', 'home@index');

/**
 * User
 * System
 */
Route::run('/user/create', 'user@create', 'post');
Route::run('/user/delete/{id}', 'user@delete');

/**
 * Post
 * System
 */
Route::run('/post/create', 'post@create', 'post');
Route::run('/post/delete/{id}', 'post@delete');
Route::run('/post/getAll', 'post@getAll');
Route::run('/post/get/{id}', 'post@get');
Route::run('/post/{id}', 'post@viewPost');

/**
 * Category
 * System
 */
Route::run('/category/create', 'category@create', 'post');
Route::run('/category/delete/{id}', 'category@delete');

/**
 * Comment
 * System
 */
Route::run('/comment/create', 'comment@create', 'post');
Route::run('/comment/delete/{id}', 'comment@delete', 'post');
Route::run('/commentpost/{id}', 'commentpost@index');
Route::run('/getComments/', 'comment@getComments');
Route::run('/comment/get', 'comment@get', 'post');
// http://localhost/getComments/?id=19
Route::run('/comment/new', 'comment@newComment', 'post');
