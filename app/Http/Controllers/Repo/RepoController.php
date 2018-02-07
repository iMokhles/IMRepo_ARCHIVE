<?php

namespace App\Http\Controllers\Repo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class RepoController extends Controller
{
    public function getRelease(Request $request) {

        $origin = Config::get('settings.release_origin');
        $label = Config::get('settings.release_label');
        $version = Config::get('settings.release_version');
        $description = Config::get('settings.release_description');

        $md5_packages = md5_file(storage_path('Packages'));
        $md5_packagesBz = md5_file(storage_path('Packages.bz2'));
        $md5_packagesGz = md5_file(storage_path('Packages.gz'));

        $size_packages = filesize(storage_path('Packages'));
        $size_packagesBz = filesize(storage_path('Packages.bz2'));
        $size_packagesGz = filesize(storage_path('Packages.gz'));

        $release_file_content = "Origin: $origin
Label: $label
Suite: stable
Version: $version
Codename:
Architectures: iphoneos-arm
Components: main
Description: $description
MD5Sum:
$md5_packages $size_packages Packages
$md5_packagesGz $size_packagesGz Packages.gz
$md5_packagesBz $size_packagesBz Packages.bz2";

        $releaseFile = storage_path("Release");

        if (file_exists($releaseFile)) {
            unlink($releaseFile);

            $handle = fopen($releaseFile, "w");
            $size = fwrite($handle, $release_file_content) ;//str_replace(" ", "", $release_file_content));
            fclose($handle);

//        dd($releaseFile);
            return response()->download($releaseFile, 'Release', [
                'Content-Type' => 'application/octet-stream'
            ]);
        } else {
            $handle = fopen($releaseFile, "w");
            $size = fwrite($handle, $release_file_content) ;//str_replace(" ", "", $release_file_content));
            fclose($handle);

//        dd($releaseFile);
            return response()->download($releaseFile, 'Release', [
                'Content-Type' => 'application/octet-stream'
            ]);
        }
    }

    public function getSignedRelease(Request $request) {

    }

    public function getCydiaIcon(Request $request) {
        $releaseFile = storage_path("icon/CydiaIcon.png");
        return response()->download($releaseFile, 'CydiaIcon', [
            'Content-Type' => 'application/octet-stream'
        ]);
    }

    public function getCydiaIconPng(Request $request) {
        $releaseFile = storage_path("icon/CydiaIcon.png");
        return response()->download($releaseFile, 'CydiaIcon.png', [
            'Content-Type' => 'application/octet-stream'
        ]);
    }
}
