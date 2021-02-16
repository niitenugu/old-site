<?php

// This route handles "account deactivated" operation
Route::group( ['middleware' => ['auth']], function() {
	Route::get('account-deactivated', function () {
		if (auth()->user()->is_active) {
			return redirect()->route('dashboard');
		}
		return view('errors.account_deactivated');
	})->name('admin.account_deactivated');
});

Route::group( ['middleware' => ['auth', 'user.status']], function() {
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	Route::put('users/status/{uid}', 'UserController@status')->name('admin.users.status');
	Route::resource('/users', 'UserController', ['as' => 'admin']);

	Route::resource('/categories', 'CategoryController', ['as' => 'admin']);

	Route::resource('/courses', 'CourseController', ['as' => 'admin']);

	Route::put('events/status/{uid}', 'EventController@status')->name('admin.events.status');
	Route::resource('/events', 'EventController', ['as' => 'admin']);

	Route::delete('/attendees/{uid}', 'AttendeeController@destroy')->name('admin.attendees.destroy');
	Route::get('/events/{eventId}/attendees', 'AttendeeController@index')->name('admin.attendees.index');
	Route::get('/events/{eventId}/attendees/create', 'AttendeeController@create')->name('admin.attendees.create');
	Route::post('/events/{eventId}/attendees/create', 'AttendeeController@store')->name('admin.attendees.store');
	Route::get('/events/{eventId}/attendees/{uid}/edit', 'AttendeeController@edit')->name('admin.attendees.edit');
	Route::put('/events/{eventId}/attendees/{uid}/edit', 'AttendeeController@update')->name('admin.attendees.update');
	Route::get('/events/{eventId}/attendees/checkin', 'AttendeeController@checkIn')->name('admin.attendees.checkin');
	Route::put('/events/{eventId}/attendees/{uid}/checkin', 'AttendeeController@postCheckIn')->name('admin.attendees.post_checkin');

	Route::put('scholarships/status/{uid}', 'ScholarshipController@status')->name('admin.scholarships.status');
	Route::resource('/scholarships', 'ScholarshipController', ['as' => 'admin']);

	Route::delete('/attendees/scholarships/{uid}', 'ScholarshipAttendeeController@destroy')->name('admin.scholarship_attendees.destroy');
	Route::get('/scholarships/{scholarshipId}/attendees', 'ScholarshipAttendeeController@index')->name('admin.scholarship_attendees.index');
	Route::get('/scholarships/{scholarshipId}/attendees/create', 'ScholarshipAttendeeController@create')->name('admin.scholarship_attendees.create');
	Route::post('/scholarships/{scholarshipId}/attendees/create', 'ScholarshipAttendeeController@store')->name('admin.scholarship_attendees.store');
	Route::get('/scholarships/{scholarshipId}/attendees/{uid}/edit', 'ScholarshipAttendeeController@edit')->name('admin.scholarship_attendees.edit');
	Route::put('/scholarships/{scholarshipId}/attendees/{uid}/edit', 'ScholarshipAttendeeController@update')->name('admin.scholarship_attendees.update');
	Route::get('/scholarships/{scholarshipId}/attendees/checkin', 'ScholarshipAttendeeController@checkIn')->name('admin.scholarship_attendees.checkin');
	Route::put('/scholarships/{scholarshipId}/attendees/{uid}/checkin', 'ScholarshipAttendeeController@postCheckIn')->name('admin.scholarship_attendees.post_checkin');

	Route::resource('/jobs', 'JobController', ['as' => 'admin']);
});