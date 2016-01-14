<?php

// CRUD route of QDN
Route::get('/report',
[
    'as' => 'issue_qdn',
    'uses' => 'reportController@report'
]);

Route::post('/report',
[
    'as' => 'issue_qdn',
    'uses' => 'reportController@store'
]);

Route::get('/report/{slug}',
[
    'as' => 'qdn_form_link',
    'uses' => 'reportController@show'
]);

