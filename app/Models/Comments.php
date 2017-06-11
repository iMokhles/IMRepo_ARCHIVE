<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Comments extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'comments';
    protected $primaryKey = 'id';
     public $timestamps = true;
     protected $guarded = ['id'];
     protected $fillable = [
         'user_id',
         'comment',
         'rate',
         'approved',
         'package_id',
         'commented_type'
     ];
    // protected $hidden = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'approved' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function package()
    {
        return $this->morphTo();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function user()
    {
        return $this->morphTo();
    }
    /**
     * @return $this
     */
    public function approve()
    {
        $this->approved = true;
        $this->save();
        return $this;
    }
}
