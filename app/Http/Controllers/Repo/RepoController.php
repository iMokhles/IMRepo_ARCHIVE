<?php

namespace App\Http\Controllers\Repo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepoController extends Controller
{
    public function getRelease(Request $request) {

        $releaseFile = storage_path("Release");
        return response()->file($releaseFile)->header("Content-Type", "text/plain");
    }

    public function getSignedRelease(Request $request) {

    }
}
