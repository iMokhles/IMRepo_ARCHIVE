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

        $release_file_content = "Origin: $origin
Label: $label
Suite: stable
Version: $version
Codename:
Architectures: iphoneos-arm
Components: main
Description: $description";

        $releaseFile = storage_path("Release");

        $handle = fopen($releaseFile, "w");
        $size = fwrite($handle, $release_file_content) ;//str_replace(" ", "", $release_file_content));
        fclose($handle);

        return response()->file($releaseFile)->header("Content-Type", "text/plain");
    }

    public function getSignedRelease(Request $request) {

    }
}
