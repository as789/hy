<?php

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Permission extends Model
{
   
	protected $name = 'permisions';

    protected $fillable = [

        'name', 'url','display_name', 'description','icon','sort','is_show','pid',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'permission_role', 'permission_id', 'role_id');
    }
}
