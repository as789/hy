<?php

namespace App\Services\Admin;

use App\Repositories\AdminRepository;


class AdminService
{
    public $adminRepository;

    const LIMIT = 15;

    public function __construct(AdminRepository $adminRepository){

        $this->adminRepository = $adminRepository;
    }
    
    /**
     * 添加数据
     */
    public function create($param){
        
        $param['password'] =  password_hash($param['password'],1);

        if(!empty($param['role'])){

 			$param['role'] = explode(",",$param['role']);
        }
        
    	$res = $this->adminRepository->create($param);
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

    	$data = $this->adminRepository->getList($limit);
    	$count = $data->total();
    	$data = $data->toArray();
        
    	foreach ($data['data'] as $key => &$value) {
    		$value['role']= "";
    		foreach ($value['roles'] as $k => $val) {
                
    			$value['role'] .= "，".$val['name'];
    		}

    		$value['role'] = trim($value['role'],"，");
    		unset($data['data'][$key]['roles']);
    	}
    	
    	$data['code'] = 0;
    	$data['count'] = $count;
    	return $data;
    }


    public function edit($id){

    	$data = $this->adminRepository->getDataByfillable(['id'=>$id]);

    	foreach ($data->roles as $key => $value) {
    		$data->role .= ','.$value->pivot->role_id;
    	}

    	$data->role = trim($data->role,',');
    	return $data;
    }

     public function update($param,$id){

        if(!empty($param['role'])){

 			$param['role'] = explode(",",$param['role']);
        }
        
    	$res = $this->adminRepository->update($param,$id);
    	return $res;
    }
    

    public function destroy($id){

    	$res = $this->adminRepository->delete($id);
    	return $res;

    }
}
