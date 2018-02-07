<?php

namespace App\Http\Controllers\Repo;

use App\Helpers\Helper;
use App\Helpers\IMHelper;
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

        return $this->sendResponse('LOL', 202);

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
        if (file_exists($packagesFile)) {
            return;
            unlink($packagesFile);

            $handle = fopen($packagesFile, "w");
            $size = fwrite($handle, $packagesText);
            fclose($handle);

            return response()->download($packagesFile, 'Packages',[
                'Content-Type' => 'application/octet-stream'
            ]);
        } else {
            return;
            $handle = fopen($packagesFile, "w");
            $size = fwrite($handle, $packagesText);
            fclose($handle);

            return response()->download($packagesFile, 'Packages',[
                'Content-Type' => 'application/octet-stream'
            ]);
        }

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
        if (file_exists($bz2File)) {
            unlink($bz2File);
            $b_handle = bzopen($bz2File, "w");
            $size = bzwrite($b_handle, file_get_contents($packagesFile));
            bzclose($b_handle);

            return response()->download($bz2File, 'Packages.bz2', [
                'Content-Type' => 'application/octet-stream'
            ]);
        } else {
            $b_handle = bzopen($bz2File, "w");
            $size = bzwrite($b_handle, file_get_contents($packagesFile));
            bzclose($b_handle);

            return response()->download($bz2File, 'Packages.bz2', [
                'Content-Type' => 'application/octet-stream'
            ]);
        }
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
        if (file_exists($gzFile)) {
            unlink($gzFile);

            $b_handle = gzopen($gzFile, "w");
            $size = gzwrite($b_handle, file_get_contents($packagesFile));
            gzclose($b_handle);

            return response()->download($gzFile, 'Packages.gz', [
                'Content-Type' => 'application/octet-stream'
            ]);

        } else {
            $b_handle = gzopen($gzFile, "w");
            $size = gzwrite($b_handle, file_get_contents($packagesFile));
            gzclose($b_handle);

            return response()->download($gzFile, 'Packages.gz', [
                'Content-Type' => 'application/octet-stream'
            ]);
        }

    }

    public function getPackageFile(Request $request, $packageHash) {

        $debsPath = storage_path('debs');
        $filePath = $debsPath."/".$packageHash.".deb";
        $package = IMHelper::first("packages", [
            'package_hash' => $packageHash
        ]);
        if ($package != null) {
            // increase downloads for package
            $packageUpdated = IMHelper::updateRecord('packages', [
                'id' => $package->id
            ], [
                'Downloads' => $package->Downloads+1,
            ]);
            if ($packageUpdated) {
                // check if user downloaded this package before of not
                $userPackage = IMHelper::first('users_packages', [
                    'package_id' => $package->id
                ]);
                if ($userPackage != null) {
                    // user downloaded this package before
                    IMHelper::updateRecord('users_packages', [
                        'package_id' => $package->id,
                    ],[
                        'downloads' => $userPackage->downloads+1,
                    ]);
                } else {
                    // user download this package for the first time
                    IMHelper::insertToTable('users_packages', [
                        'user_id' => \Auth::user()->id,
                        'package_id' => $package->id,
                        'downloads' => 1,
                    ]);
                }
            }
        }
        return response()->download($filePath, "$packageHash.deb", [
            'Content-Type' => 'application/octet-stream',
            'Content-Transfer-Encoding' => 'binary',
            'Cache-Control' => 'public, must-revalidate, max-age=0',
            'Content-Disposition' => 'attachment; filename="'.$packageHash.'.deb"',
            'Content-Length: '. filesize($filePath)
        ]);
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
