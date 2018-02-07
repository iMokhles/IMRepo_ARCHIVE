<?php
namespace App\Repositories;

use App\Helpers\IMHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Packages;
use App\Repositories\Interfaces\PackagesRepositoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Helpers\Helper;
use Ramsey\Uuid\Uuid;

class PackagesRepository extends Repository implements PackagesRepositoryInterface
{
    public function __construct(Packages $model)
    {
        parent::__construct($model);
    }

    protected function sendResponse($message, $error_code)
    {
        return response()->json([
            'message' => $message,
            'status' => Response::$statusTexts[$error_code],
            'status_code' => $error_code
        ])->setStatusCode($error_code, Response::$statusTexts[$error_code]);
    }

    protected function sendUploadErrorResponse($message, $error_code)
    {
        return response()->json($message)->setStatusCode($error_code, Response::$statusTexts[$error_code]);
    }

    public function upload( Request $request, $fileVar ) {

        $validator = Validator::make(
            [
                'file' => $fileVar,
                'extension'  => 'deb',
            ],
            [
                'file' => 'required|max:100000',
                'extension'  => 'required|in:deb'
            ]
        );

        if ($validator->passes()) {
            $files[] = $fileVar;
            $file_unique_name = Str::random(10);
            if (count($files) > 0) {
                foreach ($files as $deb_file) {

                    $file_unique_name = time().$file_unique_name;

                    $helper = new Helper();
                    $control = $helper->GetPkgInfo($deb_file);

                    $inserted = $this->saveDebInfoInDatabase($control, $file_unique_name);
                    if ($inserted) {
                        $extension = $deb_file->getClientOriginalExtension();
                        $path = Storage::disk('storage')->putFileAs(
                            'debs', $deb_file, $file_unique_name.".".$extension
                        );
                        if (strlen($path) > 5) {
                            return $this->sendResponse("File Uploaded To Path: ".$path, Response::HTTP_OK);
                        } else {
                            return $this->sendUploadErrorResponse("Failed", Response::HTTP_BAD_REQUEST);
                        }
                    } else {
                        return $this->sendUploadErrorResponse("Failed Already Exist", Response::HTTP_BAD_REQUEST);
                    }

                }

            } else {
                return $this->sendUploadErrorResponse("Failed", Response::HTTP_BAD_REQUEST);
            }
        } else {
            return $this->sendResponse($validator->errors()->getMessages(), Response::HTTP_OK);
        }
    }
    public function saveDebInfoInDatabase($control_info, $file_name) {
        $deb_version = $control_info['Version'];
        $deb_identifier = $control_info['Package'];
        $isExist = IMHelper::first('packages', [
            'Package' => $deb_identifier,
            'Version' => $deb_version
        ]);
        if ($isExist) {
            return false;
        } else {
            $control_info['UUID'] = Uuid::uuid5(Uuid::NAMESPACE_DNS, $deb_identifier.$deb_version);
            $control_info['Filename'] = "debs/".$file_name;

            $control_info['Stat'] = true;
            $control_info['package_hash'] = $file_name;
            $control_info['user_id'] = \Auth::user()->id;
            $control_info['created_at'] = Carbon::now();
            $control_info['updated_at'] = Carbon::now();
            $inserted = IMHelper::insertToTableGetId('packages', $control_info);

//            $inserted = Packages::create($control_info);
            if ($inserted > 0) {
                $this->saveChangeLog($control_info, $inserted);
            }
            return $inserted;
        }
    }

    public function saveChangeLog($package_info, $package_id) {

        $isExist = IMHelper::first('packages', [
            'Package' => $package_info['Package'],
        ]);
        $isChangeLogExist = IMHelper::first("changelogs", [
            'package_bundle' => $package_info['Package'],
        ]);
        $text = "";
        if ($isExist != null && $isChangeLogExist != null) {
            $text = "* new release";
        } else {
            $text = "* new release";
        }
        $inserted = IMHelper::insertToTable('changelogs', [
            'package_id' => $package_id,
            'package_hash' => $package_info['package_hash'],
            'package_version' => $package_info['Version'],
            'changelog_text' => $text,
            'package_bundle' => $package_info['Package']
        ]);
        return $inserted;
    }
}