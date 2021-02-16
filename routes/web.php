<?php

Route::get('/', 'StaticPageController@homepage')->name('homepage');

Route::get('/about', 'StaticPageController@about')->name('about');

Route::get('/contact', 'StaticPageController@contact')->name('contact');
Route::post('/contact', 'StaticPageController@submitContactForm')->name('submit_contact_form');

Route::post('/scholarship/register', 'ScholarshipAttendeeController@store')->name('scholarship_attendee.store');
// Route::redirect('/scholarship/register', '/scholarship', 301);

// NOTE: Always keep "/courses/search" on top of other "/courses" routes
Route::get('/courses/search', 'CourseController@search')->name('courses.search');
Route::get('/courses', 'CourseController@index')->name('courses.index');
Route::get('/courses/{slug}', 'CourseController@show')->name('courses.show');

Route::get('/events', 'EventController@index')->name('events.index');
Route::get('/events/{slug}', 'EventController@show')->name('events.show');
Route::post('/events/{eventId}/attendees/create', 'AttendeeController@store')->name('attendees.store');

Route::get('/careers', 'JobController@index')->name('careers.index');
Route::get('/careers/{slug}', 'JobController@show')->name('careers.show');

Route::redirect('/home', '/admin/dashboard', 301);

// Authentication Routes...
Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
/*$this->get('/signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('/signup', 'Auth\RegisterController@register');*/

// Password Reset Routes...
Route::get('/admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/admin/password/reset', 'Auth\ResetPasswordController@reset');
