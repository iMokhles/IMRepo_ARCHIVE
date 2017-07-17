<?php


CRUD::resource('packages-list', 'PackagesCrudController');
CRUD::resource('udids', 'UDIDsCrudController');
CRUD::resource('payments', 'PaymentsCrudController');
CRUD::resource('depictions', 'DepictionCrudController');
CRUD::resource('changelogs', 'ChangelogsCrudController');
CRUD::resource('screenshots', 'ScreenshotsCrudController');
CRUD::resource('activities', 'ActivitiesCrudController');
CRUD::resource('setting', 'OptionsCrudController');

Route::resource('upload_package', 'UploadController');
