<?php

namespace App\Http\Controllers\Repo;

use App\Helpers\IMHelper;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
{
    public function packages(Request $request) {
        $search_term = $request->input('q');

        $package = Packages::where('Name', 'LIKE', '%'.$search_term.'%')->first();
        $last_version = IMHelper::getLastVersionAvailabe($package->Package);
        $results = Packages::where('Name', 'LIKE', '%'.$search_term.'%')
            ->where('Version', $last_version)->paginate(10);


        return $results;
    }
}
