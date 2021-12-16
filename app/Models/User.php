<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];
    protected $appends = ['image_path','allPermissions','allRoles'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get first name

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get last name

    public function getImagePathAttribute()
    {
        return asset('uploads/user_images/' . $this->image);

    }//end of get image path

    public function getAllPermissionsAttribute() {
        $permissions = [];
          foreach ($this->allPermissions() as $permission) {

            if (\Auth::user()->hasPermission($permission->name)) {

              $permissions[] = $permission->name;
            }
          }

        return $permissions;
     }
     public function getAllRolesAttribute() {
        $roles = [];
          foreach ($this->getRoles() as $role) {

            if (\Auth::user()->whereRoleIs($role)) {

              $roles[] = $role;
            }
          }

        return $roles;
     }
}
