<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\IMHelper;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $helper = new Helper();

        $queryPackages = DB::table("packages")->select(config('repo_config.packages_select'));
        $queryPackages = $queryPackages->where([
            "Stat" => true
        ]);
        // get all packages
//        $packagesResults = $queryPackages->get();

        // search package
        $search_term = $request->input('q');
        if ($search_term) {
            $queryPackages = $queryPackages->where('name', 'LIKE', '%'.$search_term.'%');
        }
        // packages paginations
        $packagesResults = $queryPackages->paginate(10);
        $resaultPag = $packagesResults->toArray();

//        dd($resaultPag);
        $packagesText = "";
        $packages = array();
        foreach ($packagesResults as $package) {
            if ($package == null)
                continue;
            if (!isset($packages[$package->Package]))
                $packages[$package->Package] = $package;
            else
                // Compare version numbers
                if ($helper->CompareVersions($package->Version, $packages[$package->Package]->Version) > 0)
                    $packages[$package->Package] = $package;
        }

//        return $packages;
        $data = [];
        $data['all_packages'] = $packages;
        $data['pagination'] = $resaultPag;

        return view('home', $data);
    }

    public function show(Request $request, $package_hash) {
        $package = IMHelper::first("packages", [
            'package_hash' => $package_hash,
        ]);
        if ($package != null) {
            $data = [];
            $data['package'] = $package;

            return view('package_info', $data);
        } else {
            return abort(404);
        }

    }
}
