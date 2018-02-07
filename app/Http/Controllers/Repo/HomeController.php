<?php

namespace App\Http\Controllers\Repo;

use App\Helpers\Helper;
use App\Helpers\IMHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(Request $request) {
        return view('home');
    }

    public function show(Request $request, $package_hash) {

        return view('package_info');
    }

    public function depiction(Request $request, $package_hash) {

        $data = [];
        $package = IMHelper::first("packages", [
            'package_hash' => $package_hash
        ]);
        if ($package != null) {
            $depiction = IMHelper::first("depictions", [
                'package_id' => $package->id
            ]);
            if ($depiction != null) {
                $data['package'] = $package;
                $data['depiction'] = $depiction;
                $data['last_version'] = "";
                return view('mobile.depiction.index',$data);
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }

    }
    public function screenshot(Request $request, $image_hash) {
        $screenshot = IMHelper::first("screenshots", [
            'image_hash' => $image_hash
        ]);
        $full_path = storage_path("$screenshot->image_path");
        return response()->file($full_path);
    }
    public function icon(Request $request, $section_name) {
        $full_path = storage_path("app/public/sections/$section_name".".png");
        if (file_exists($full_path)) {
            return response()->file($full_path);
        }
        $full_path = storage_path("app/public/sections/Tweaks.png");
        return response()->file($full_path);

    }
    public function changelogs(Request $request, $package_bundle) {
        $last_version = IMHelper::getLastVersionAvailabe($package_bundle);
        $package = IMHelper::first("packages", [
            'Package' => $package_bundle,
            'Version' => $last_version
        ]);
        if ($package != null) {
            $change_logs = IMHelper::allWhere("changelogs", [
                'package_bundle' => $package_bundle
            ]);
            if ($change_logs != null) {
                $data = [];
                $data['Name'] = $package->Name;
                $data['change_logs'] = $change_logs;

                return view('mobile.depiction.change-log',$data);
            } else {
                return abort(404);
            }

        } else {
            return abort(404);
        }

    }
}
