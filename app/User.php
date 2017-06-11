<?php

namespace App;

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
}
