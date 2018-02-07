<?php

namespace App\Models;

use App\Helpers\IMHelper;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prologue\Alerts\Facades\Alert;

class Screenshots extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'screenshots';
    protected $primaryKey = 'id';
     public $timestamps = true;
     protected $guarded = ['id'];
     protected $fillable = [
         'package_id',
         'image_path',
         'image_hash',
         'image_md5',
         'image_ext'
     ];
    // protected $hidden = [];
    protected $dates = ['created_at', 'updated_at'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            $delete_path = "screenshots/".$obj->package_id."/".$obj->image_hash;
            Storage::disk('storage')->deleteDirectory($delete_path);
        });
    }

    public function setImagePathAttribute($value)
    {
        $screenshot_hash = Str::random(10);
        $attribute_name = "image_path";
        $disk = "storage";
        $destination_path = "screenshots/".$this->package_id."/".$screenshot_hash;
        $all_screenshots = IMHelper::allWhere('screenshots', [
            'package_id' => $this->package_id
        ]);
        if (count($all_screenshots) <= 7) {
            $image_path1 = $this->im_uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
            $image_path = $image_path1;
            $name = pathinfo($image_path, PATHINFO_FILENAME);
            $ext = pathinfo($image_path, PATHINFO_EXTENSION);

            $this->attributes['image_hash'] = $screenshot_hash;
            $this->attributes['image_md5'] = $name;
            $this->attributes['image_ext'] = $ext;

        }
    }

    public function im_uploadFileToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = Request::instance();

        // if a new file is uploaded, delete the file from the disk
        if ($request->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name) && $request->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = $request->file($attribute_name);
            $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = $file_path;

            return $file_path;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Packages::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
