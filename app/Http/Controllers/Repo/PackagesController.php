<?php

namespace App\Http\Controllers\Repo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller
{


    public function __construct() {
    }

    public function getPackages(Request $request) {
        $packagesFile = storage_path("Packages");
        return response()->file($packagesFile);
    }

    public function generateBZipPackages(Request $request) {

        $queryPackages = DB::table("packages")->select(config('repo_config.packages_select'));
        $queryPackages = $queryPackages->where([
            "Stat" => true
        ]);
        $packagesResults = $queryPackages->get();

        $packagesText = "";
        foreach ($packagesResults as $package) {
            $packageText = "";
            $package['Filename'] = "Packages/".$package->package_hash;
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

        return response()->file($bz2File);
    }

    public function generateGzPackages(Request $request) {

        $packagesFile = storage_path("Packages");
        $gzFile = storage_path("Packages.gz");

        $b_handle = gzopen($gzFile, "w");
        $size = gzwrite($b_handle, file_get_contents($packagesFile));
        gzclose($b_handle);

        return response()->file($gzFile);
    }

    public function getPackageFile(Request $request, $packageHash) {

        $debsPath = storage_path('debs');
        $filePath = $debsPath."/".$packageHash;

        return response()->file($filePath);
    }
}
