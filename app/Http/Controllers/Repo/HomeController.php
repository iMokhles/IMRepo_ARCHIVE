<?php

namespace App\Http\Controllers\Repo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index(Request $request) {

        return view('home');
    }

    public function show(Request $request, $package_hash) {

        return view('package_info');
    }
}
