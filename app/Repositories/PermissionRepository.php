<?php

namespace App\Repositories;

use App\Model\Permission;
use Hyperf\DbConnection\Db;

class PermissionRepository
{
    public $permission;

    public function __construct(Permission $permission){

        $this->permission = $permission;
    }
    
    /**
     * 添加数据
     * @return [type] [description]
     */
    public function create($data){
        
        try{

		    $Permission = $this->permission->create($data);
		    	
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

            $Permissions = $this->permission->find($id);
		    $Permissions->fill($data)->save();

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
                 
                $Permissions = $this->permission->find($id);
		    	$Permissions->delete();
		    	$Permissions->roles()->detach();

    		});

        }catch(\Throwable $ex){

        	return false;
        }

        return true;


    }
    
    
    public function getDataByfillable($data){
        
    	return $this->permission->where($data)->first();
    }



    public function getList($limit){
        
    	return $this->permission->orderBy('id','asc')->get();

    }

    
}
