<?php

namespace App;

use App\Models\Activities;
use App\Models\Comments;
use App\Models\Packages;
use App\Models\Payments;
use App\Models\Rates;
use App\Models\UDIDs;
use App\Models\UsersPackages;
use App\Traits\CanUseCommentsTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait; // <----- this
    use HasRoles;
    use CanUseCommentsTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        if ($this->hasRole('super_admin')) {
            $this->notify(new ResetPasswordNotification($token));
        } else {
            // not admin send another email
        }

    }

    public function isAdmin() {
        return $this->hasRole('super_admin');
    }
    function uploaded_packages() {
        return $this->hasMany(Packages::class);
    }
    function udids() {
        return $this->hasMany(UDIDs::class);
    }
    function payments() {
        return $this->hasMany(Payments::class);
    }
    function activities() {
        return $this->hasMany(Activities::class);
    }
    function comments() {
        return $this->hasMany(Comments::class);
    }
    function rates() {
        return $this->hasMany(Rates::class);
    }
    function packages() {
        return $this->hasMany(UsersPackages::class);
    }
}
