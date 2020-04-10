<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller\Admins;


use App\Model\Admin;
use Hyperf\Di\Annotation\Inject;
use App\Request\RoleRequest;
use App\Services\Admin\RoleService;
use App\Exception\RequetErrorException;
use Hyperf\HttpMessage\Stream\SwooleStream;

class RoleController extends AbstractController
{   
   
   public $roleService;

    public function __construct(RoleService $roleService){

        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->render->render('admin/role/index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {   

        $limit = $this->request->input('limit');
        $data =  $this->roleService->getList($limit);
        return $this->response->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        
        return $this->render->render('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
       
        $res =  $this->roleService->create($request->validated()); 

         $data =array(

            'code' =>200,

            'message'=>'添加成功',

            'data'=>[]

        );
        return $this->response->withStatus(200)->withBody(new SwooleStream(json_encode($data)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data =  $this->roleService->edit($id);

         return $this->render->render('admin.role.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $res =  $this->roleService->update($request->post(),$id); 

         $data =array(

            'code' =>200,

            'message'=>'管理员修改',

            'data'=>[]

        );
        return $this->response->withStatus(200)->withBody(new SwooleStream(json_encode($data)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res =  $this->roleService->destroy($id); 
        $data =array(

            'code' =>200,

            'message'=>'删除成功',

            'data'=>[]

        );
        return $this->response->withStatus(200)->withBody(new SwooleStream(json_encode($data)));
    }

}
