<?php

namespace App\Http\Models\Backend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'created_at', 'updated_at'
    ];

    const SUPPER_USER = 'admin';
    const IS_ADMIN = 1;
    const IS_COMPANY = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_HIDE = 0;
    const PAGE_SIZE = 10;
    const ANDROID_ID = 1;
    const IOS_ID = 2;
    static $TYPE = [
        self::IS_ADMIN => "Admin",
        self::IS_COMPANY => "Doanh nghiệp"
    ];

    static $STATUS = [
        self::STATUS_ACTIVE => "Hiện",
        self::STATUS_HIDE => "Ẩn"
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'id', 'asign_to');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles)) {
            foreach ($roles as $role) {
                if($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if($this->hasRole($roles)) {
                    return true;
                }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->is_admin == $role) {
            return true;
        }
        $check_permission = RolePermission::where('role_id', $this->role_id)->where('permission', $role)->first();
        if($check_permission) {
            return true;
        }
        return false;
    }

    public static function getListDropdownCompany() {
        return self::select('id','email')->where('is_admin', self::IS_COMPANY)->orderBy('email')->get();
    }
}
