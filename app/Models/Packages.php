<?php

namespace App\Models;

use App\Traits\CommentAbleTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\Storage;

class Packages extends Model
{
    use CrudTrait;
    use CommentAbleTrait;
     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $mustBeApproved = true;

    protected $table = 'Packages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'Package',
        'Name',
        'Version',
        'Size',
        'Installed-Size',
        'package_hash',
        'Stat'
    ];
//    protected $hidden = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'Stat' => 'boolean'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            $delete_path = "debs/".$obj->package_hash.".deb";
            Storage::disk('storage')->delete($delete_path);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    function user() {
        return $this->belongsTo(User::class);
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
