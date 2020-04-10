<?php

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Role extends Model
{
   
	protected $name = 'roles';

    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function admins()
    {
        return $this->belongsToMany('App\Model\Admin', 'role_admin', 'role_id', 'admin_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission', 'permission_role', 'role_id','permission_id');
    }
}
