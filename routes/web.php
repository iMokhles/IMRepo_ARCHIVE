<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/{package_hash}', 'HomeController@show')->name('show_package');

Route::get('/Packages/{packageHash}', 'Repo\PackagesController@getPackageFile');

Route::get('/Packages', 'Repo\PackagesController@getPackages');

Route::get('/Packages.bz2', 'Repo\PackagesController@generateBZipPackages');

Route::get('/Packages.gz', 'Repo\PackagesController@generateGzPackages');

Route::get('/Release', 'Repo\RepoController@getRelease');

Route::get('/Release.gpg', 'Repo\RepoController@getSignedRelease');

Auth::routes();

