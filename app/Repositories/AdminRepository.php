<?php

namespace App\Repositories;

use App\Model\Admin;
use Hyperf\DbConnection\Db;

class AdminRepository
{
    public $admin;

    public function __construct(Admin $admin){

        $this->admin = $admin;
    }
    
    /**
     * 添加数据
     * @return [type] [description]
     */
    public function create($data){
        
        try{

        	DB::transaction(function () use($data) {

		    	$admin = $this->admin->create($data);
		    	$admin->roles()->sync($data['role']);

    		});

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

        	DB::transaction(function () use($data,$id) {
                 
                $admins = $this->admin->find($id);
		    	$admins->fill($data)->save();
		    	$admins->roles()->sync($data['role']);

    		});

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
                 
                $admins = $this->admin->find($id);

		    	$admins->delete();
		    	$admins->roles()->detach();

    		});

        }catch(\Throwable $ex){

        	return false;
        }

        return true;


    }
    
    
    public function getDataByfillable($data){
        
    	return $this->admin->with('roles:id,name')->where($data)->first();
    }



    public function getList($limit){
        
    	return $this->admin->with('roles:id,name')->orderBy('id','desc')->paginate($limit);

    }

    
}
