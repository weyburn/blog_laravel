<?php


/**
 * FRONTEND
 */

Route::group([
    'namespace' => 'Frontend',
], function () {
    // index
    Route::get('/', 'IndexController@index')->name('frontend.index.index');
    // archive
    Route::get('archive', 'ArchiveController@index')->name('frontend.archive.index');
    // category
    Route::get('category', 'CategoryController@index')->name('frontend.category.index');
    Route::get('category/{name}', 'CategoryController@show')->name('frontend.category.show');
    // tag
    Route::get('tag', 'TagController@index')->name('frontend.tag.index');
    Route::get('tag/{name}', 'TagController@show')->name('frontend.tag.show');
    // about
    Route::get('about', 'AboutController@index')->name('frontend.about.index');
    // post
    Route::get('post/{title}', 'PostController@show')->name('frontend.post.show');
    // comment
    Route::post('comment','CommentController@create')->name('frontend.comment.create');
});


/**
 * BACKEND
 */

Route::group([
    'namespace' => 'Backend',
    'prefix' => 'admin',
], function () {
    Route::get('login', 'AuthController@index')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::group([
        'middleware' => 'auth'
    ], function () {
        Route::get('/', 'IndexController@index');
        Route::get('test', 'TestController@index');
        Route::resource('category', 'CategoryController');
        Route::resource('post', 'PostController');
        Route::resource('tag', 'TagController');
        Route::resource('comment', 'CommentController');
    });
});
