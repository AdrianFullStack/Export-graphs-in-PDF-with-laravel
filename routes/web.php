<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');
Route::post('users/list', 'UserController@list_register')->name('users-list');
Route::get('/user/view/graph', 'UserController@view_graph')->name('users-graph');
Route::post('/user/download/pdf', 'UserController@download_pdf')->name('download-pdf');
