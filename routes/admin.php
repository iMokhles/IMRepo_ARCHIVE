<?php


CRUD::resource('packages', 'PackagesCrudController');
CRUD::resource('udids', 'UDIDsCrudController');
CRUD::resource('payments', 'PaymentsCrudController');
CRUD::resource('changelogs', 'ChangelogsCrudController');
CRUD::resource('screenshots', 'ScreenshotsCrudController');
CRUD::resource('activities', 'ActivitiesCrudController');


Route::resource('upload_package', 'UploadController');
