<?php

namespace App\Services\Admin;

use App\Repositories\RoleRepository;


class RoleService
{
    public $roleRepository;

    const LIMIT = 15;

    public function __construct(RoleRepository $roleRepository){

        $this->roleRepository = $roleRepository;
    }
    
    /**
     * 添加数据
     */
    public function create($param){
       
    	$res = $this->roleRepository->create($param);
    	return $res;
    }

    /**
     * 获取列表数据
     * @param  [type] $limit [description]
     * @return [type]        [description]
     */
    public function getList($limit){
        
        if(!isset($limit) || empty($limit)){

        	$limit = self::LIMIT;
        }

    	$data = $this->roleRepository->getList($limit);
    	$count = $data->total();
    	$data = $data->toArray();

    	$data['code'] = 0;
    	$data['count'] = $count;
    	return $data;
    }


    public function edit($id){

    	$data = $this->roleRepository->getDataByfillable(['id'=>$id]);
    	return $data;
    }

     public function update($param,$id){

    	$res = $this->roleRepository->update($param,$id);
    	return $res;
    }
    

    public function destroy($id){

    	$res = $this->roleRepository->delete($id);
    	return $res;

    }
}
