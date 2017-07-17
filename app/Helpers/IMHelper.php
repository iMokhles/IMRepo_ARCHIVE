<?php
/**
 * Created by PhpStorm.
 * User: imokhles
 * Date: 16/07/2017
 * Time: 01:24
 */

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class IMHelper
{
    public static function parseSqlTable($table) {
        $f = explode('.', $table);
        if(count($f) == 1) {
            return array("table"=>$f[0], "database"=>config('crudbooster.MAIN_DB_DATABASE'));
        } elseif(count($f) == 2) {
            return array("database"=>$f[0], "table"=>$f[1]);
        }elseif (count($f) == 3) {
            return array("table"=>$f[0],"schema"=>$f[1],"table"=>$f[2]);
        }
        return false;
    }
    public static function first($table,$id) {
        $table = self::parseSqlTable($table)['table'];
        if(is_int($id)) {
            return DB::table($table)->where('id',$id)->first();
        }elseif (is_array($id)) {
            $first = DB::table($table);
            foreach($id as $k=>$v) {
                $first->where($k,$v);
            }
//            if(Schema::hasColumn($table,'deleted_at')) {
//                $first->where("deleted_at", null);
//            }
            return $first->first();
        } else {
            return DB::table($table)->where('id',$id)->first();
        }
    }
    public static function all($table) {
        $table = self::parseSqlTable($table)['table'];
        return DB::table($table)->where("deleted_at", null)->get();
    }
    public static function allWhere($table, $id) {
        $table = self::parseSqlTable($table)['table'];
        $table = DB::table($table);
        foreach($id as $k=>$v) {
            $table->where($k,$v);
        }
//        if(Schema::hasColumn($table,'deleted_at')) {
//            $table->where("deleted_at", null);
//        }
        return $table->get();
    }
    public static function delete($table,$id) {
        $table = self::parseSqlTable($table)['table'];
        if(is_int($id)) {
            return DB::table($table)->where('id',$id)->delete();
        }elseif (is_array($id)) {
            $first = DB::table($table);
            foreach($id as $k=>$v) {
                $first->where($k,$v);
            }
            return $first->delete();
        }
    }
    public static function insertToTable($table,$data=[]) {
        $data['id'] = DB::table($table)->max('id') + 1;
        if (array_key_exists('created_at', $data)) {
            if(Schema::hasColumn($table,'created_at')) {
                $data['created_at'] = date('Y-m-d H:i:s');
            }
        }
        return DB::table($table)->insert($data);
    }
    public static function updateRecord($table, $id, $data=[]) {
        if (array_key_exists('updated_at', $data)) {
            if(Schema::hasColumn($table,'updated_at')) {
                $data['updated_at'] = Carbon::now();
            }
        }
        if(is_int($id)) {
            $record_updated = DB::table($table)->where('id',$id)->update($data);
            if($record_updated) return true;
            else return false;
        } else {
            $record_updated = DB::table($table);
            foreach($id as $k=>$v) {
                $record_updated->where($k,$v);
            }
            $record_updated->update($data);
            if($record_updated) return true;
            else return false;
        }
    }
    public static function getStringAfter($symbol, $fullString) {
        return substr($fullString, strpos($fullString, $symbol)+1);
    }
    public static function getStringBefore($symbol, $fullString) {
        return substr($fullString, 0, strpos($fullString, $symbol));
    }
    public static function formatDate($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
    public static function formatDateWithHour($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i');
    }
    public static function formatBytes($bytes) {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    public static function allScreenShots($package_id) {

        return self::allWhere("screenshots", [
            'package_id' => $package_id
        ]);
    }
    public static function getLastVersionAvailabe($package_bundle) {
        $helper = new Helper();

        $queryPackages = DB::table("packages")->select(config('repo_config.packages_select'));
        $queryPackages = $queryPackages->where([
            "Stat" => true,
            "Package" => $package_bundle
        ]);
        $packagesResults = $queryPackages->get();

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

        return $packages[$package_bundle]->Version;
    }

}