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
use App\Request\AdminRequest;
use App\Services\Admin\AdminService;
use App\Exception\RequetErrorException;
use Hyperf\HttpMessage\Stream\SwooleStream;

class AdminController extends AbstractController
{   
   
   private $adminSer;

   public function __construct(AdminService $adminSer){

       $this->adminSer = $adminSer;
   }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        return $this->render->render('admin/admin/index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {   

        $limit = $this->request->input('limit');
        $data = $this->adminSer->getList($limit);
        //var_dump($data);
        return $this->response->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        

        return $this->render->render('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
       
        $res = $this->adminSer->create($request->validated()); 

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

        $data = $this->adminSer->edit($id);

       
         return $this->render->render('admin.admin.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $res = $this->adminSer->update($request->validated(),$id); 

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
    public function destroy()
    {   
    	$id = $this->request->route('id');

        $res = $this->adminSer->destroy($id); 
        $data =array(

            'code' =>200,

            'message'=>'删除成功',

            'data'=>[]

        );
        return $this->response->withStatus(200)->withBody(new SwooleStream(json_encode($data)));
    }

}
