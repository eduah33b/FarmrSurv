<?php

/*Route::get('/', function () {
	$people = ['Var 1', 'Var 2', 'Var 3'];
    return view('welcome', ['people' => $people]);
});*/


Route::get('/', 'PagesController@home');

Route::get('/home_', 'APIController@home');

Route::get('/AddSheet', function () {
    return view('pages.NewSheet');
});

Route::post('/SaveSheet', 'APIController@SaveSheet');

Route::get('/DeleteSheet/{id}', 'APIController@DeleteSheet');

Route::get('/TakeSurv/{id}', 'APIController@TakeSurv');

Route::post('/SaveSuvr', 'APIController@SaveSuvr');

Route::get('/SurvResults/{id}', 'APIController@SurvResults');