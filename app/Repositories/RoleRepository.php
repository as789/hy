<?php

namespace App\Repositories;

use App\Model\Role;
use Hyperf\DbConnection\Db;

class RoleRepository
{
    public $role;

    public function __construct(Role $role){

        $this->role = $role;
    }
    
    /**
     * 添加数据
     * @return [type] [description]
     */
    public function create($data){
        
        try{

		    $role = $this->role->create($data);
		    	
        }catch(\Throwable $ex){

        	return false;
        }

        return true;
    }

    /**
     * 修改数据
     * @return [type] [description]
     */
    public function update($data,$id){
        
        try{

            $roles = $this->role->find($id);
		    $roles->fill($data)->save();

        }catch(\Throwable $ex){

        	return false;
        }

        return true;
    }
    
    /**
     * 删除数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id){

    	try{

        	DB::transaction(function () use($id) {
                 
                $roles = $this->role->find($id);
		    	$roles->delete();
		    	$roles->admins()->detach();
                $roles->permissions()->detach();

    		});

        }catch(\Throwable $ex){

        	return false;
        }

        return true;


    }
    
    
    public function getDataByfillable($data){
        
    	return $this->role->where($data)->first();
    }



    public function getList($limit){
        
    	return $this->role->orderBy('id','desc')->paginate($limit);

    }

    
}
