<?php


Route::get('dashboard', 'DashboardController@dashboard')->name('show_dashboard');

CRUD::resource('packages-list', 'PackagesCrudController');
CRUD::resource('udids', 'UDIDsCrudController');
CRUD::resource('payments', 'PaymentsCrudController');
CRUD::resource('depictions', 'DepictionCrudController');
CRUD::resource('changelogs', 'ChangelogsCrudController');
CRUD::resource('screenshots', 'ScreenshotsCrudController');
CRUD::resource('activities', 'ActivitiesCrudController');
CRUD::resource('setting', 'OptionsCrudController');

CRUD::resource('rates', 'RatesCrudController');
CRUD::resource('comments', 'CommentsCrudController');


Route::resource('upload_package', 'UploadController');
