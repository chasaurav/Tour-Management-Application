<?php

Route::get('/', 'EnquiryController@index');
Route::get('/enquiries', 'EnquiryController@show');
Route::post('/saveEnquiry', 'EnquiryController@store');
Route::delete('/deleteEnquiry/{enquiry}', 'EnquiryController@destroy');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'PackageController@index')->name('home');
Route::get('/package/create', 'PackageController@create');
Route::post('/package/save', 'PackageController@store');
Route::get('/package/edit/{package}', 'PackageController@edit');
Route::put('/package/update/{package}', 'PackageController@update');
Route::put('/package/update/{active}/{id}', 'PackageController@updateStatus');
Route::put('/package/update/{inactive}/{id}', 'PackageController@updateStatus');
Route::delete('/package/delete/{package}', 'PackageController@destroy');
