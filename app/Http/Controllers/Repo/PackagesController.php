<?php

namespace App\Http\Controllers\Repo;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller
{

    protected $helper;

    public function __construct() {
        $this->helper = new Helper();
    }

    protected function sendResponse($message, $error_code)
    {
        return response()->json([
            'message' => $message,
            'status' => Response::$statusTexts[$error_code],
            'status_code' => $error_code
        ])->setStatusCode($error_code, Response::$statusTexts[$error_code]);
    }

    public function getPackages(Request $request) {
        $packagesFile = storage_path("Packages");
        return response()->download($packagesFile);
    }

    public function generateBZipPackages(Request $request) {

        $queryPackages = DB::table("packages")->select(config('repo_config.packages_select'));
        $queryPackages = $queryPackages->where([
            "Stat" => true
        ]);
        $packagesResults = $queryPackages->get();

        $packagesText = "";
        $packages = array();
        foreach ($packagesResults as $package) {
            if ($package == null)
                continue;
            if (!isset($packages[$package->Package]))
                $packages[$package->Package] = $package;
            else
                // Compare version numbers
                if ($this->helper->CompareVersions($package->Version, $packages[$package->Package]->Version) > 0)
                    $packages[$package->Package] = $package;
        }


        foreach ($packages as $package) {
            $packageText = "";
            foreach($package as $key => $value) {
                if (!empty($key) && !empty($value)) {
                    $packageText .= $key . ": " . trim(str_replace("\n", "\n ", $value)) . "\n";
                }
            }
            $packagesText .= $packageText . "\n";
        }

        $packagesFile = storage_path("Packages");

        $handle = fopen($packagesFile, "w");
        $size = fwrite($handle, $packagesText);
        fclose($handle);

        $bz2File = storage_path("Packages.bz2");

        $b_handle = bzopen($bz2File, "w");
        $size = bzwrite($b_handle, file_get_contents($packagesFile));
        bzclose($b_handle);

        return response()->download($bz2File);
    }

    public function generateGzPackages(Request $request) {

        $queryPackages = DB::table("packages")->select(config('repo_config.packages_select'));
        $queryPackages = $queryPackages->where([
            "Stat" => true
        ]);
        $packagesResults = $queryPackages->get();

        $packagesText = "";
        $packages = array();
        foreach ($packagesResults as $package) {
            if ($package == null)
                continue;
            if (!isset($packages[$package->Package]))
                $packages[$package->Package] = $package;
            else
                // Compare version numbers
                if ($this->helper->CompareVersions($package->Version, $packages[$package->Package]->Version) > 0)
                    $packages[$package->Package] = $package;
        }

        foreach ($packages as $package) {
            $packageText = "";
            foreach($package as $key => $value) {
                if (!empty($key) && !empty($value)) {
                    $packageText .= $key . ": " . trim(str_replace("\n", "\n ", $value)) . "\n";
                }
            }
            $packagesText .= $packageText . "\n";
        }


        $packagesFile = storage_path("Packages");

        $handle = fopen($packagesFile, "w");
        $size = fwrite($handle, $packagesText);
        fclose($handle);

        $gzFile = storage_path("Packages.gz");

        $b_handle = gzopen($gzFile, "w");
        $size = gzwrite($b_handle, file_get_contents($packagesFile));
        gzclose($b_handle);

        return response()->download($gzFile);
    }

    public function getPackageFile(Request $request, $packageHash) {

        $debsPath = storage_path('debs');
        $filePath = $debsPath."/".$packageHash.".deb";

        return response()->download($filePath);
    }

    public function test_info(Request $request) {

        $helper = new Helper();
        $packagesFile = $helper->GeneratePackages(storage_path('debs'));
        $path = Storage::disk('storage')->put('Packages', $packagesFile);
        if ($path) {
            return $this->sendResponse("Packages file updated", Response::HTTP_OK);
        } else {
            return $this->sendResponse("Failed to update Packages file", Response::HTTP_OK);
        }

    }
}
