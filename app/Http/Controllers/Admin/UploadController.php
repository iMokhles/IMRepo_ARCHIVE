<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PackagesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Helpers\Helper;

class UploadController extends Controller
{
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */

    protected $package;

    public function __construct(PackagesRepository $packagesRepository)
    {
        $this->middleware('admin');
        $this->package = $packagesRepository;
    }

    public function index(Request $request)
    {

        $data = [];
        $data['files_uploaded'] = null;
        return view('upload_debs', $data);
    }
    public function store(Request $request)
    {

        return null;

    }

    protected function get_file_size($file_path, $clear_stat_cache = false) {
        if ($clear_stat_cache) {
            if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
                clearstatcache(true, $file_path);
            } else {
                clearstatcache();
            }
        }
        return $this->fix_integer_overflow(filesize($file_path));
    }
    protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }
}
