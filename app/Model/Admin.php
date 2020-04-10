<?php
declare (strict_types=1);

namespace App\Model;

use Fx\HyperfHttpAuth\Contract\Authenticatable;
use Hyperf\DbConnection\Model\Model;

class Admin extends Model implements Authenticatable
{
    use \Fx\HyperfHttpAuth\Authenticatable;


    protected $name = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'role_admin', 'admin_id', 'role_id');
    }
}