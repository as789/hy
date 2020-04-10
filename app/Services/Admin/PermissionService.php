<?php

namespace App\Services\Admin;

use App\Repositories\PermissionRepository;


class PermissionService
{
    public $permissionRepository;

    const LIMIT = 15;

    public function __construct(PermissionRepository $permissionRepository){

        $this->permissionRepository = $permissionRepository;
    }
    
    /**
     * 添加数据
     */
    public function create($param){
       
    	$res = $this->permissionRepository->create($param);
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

    	$data = $this->permissionRepository->getList($limit);
        
         $count = $data->count();
    	$data = $data->toArray();
    	$datas['data'] = $data;

    	$datas['code'] = 0;
    	$datas['count'] =  $count ;
    	
    	return $datas;
    }


    public function edit($id){

    	$data = $this->permissionRepository->getDataByfillable(['id'=>$id]);
    	return $data;
    }

     public function update($param,$id){

    	$res = $this->permissionRepository->update($param,$id);
    	return $res;
    }
    

    public function destroy($id){

    	$res = $this->permissionRepository->delete($id);
    	return $res;

    }
}
