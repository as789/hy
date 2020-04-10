<?php

namespace App\Request;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Contract\TranslatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Rule;

class RoleRequest extends FormRequest
{   


     /**
     * @Inject
     * @var TranslatorInterface
     */
    protected $translator;


     /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;



    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {   

        $method = $this->request->getMethod();
        if($method == "PUT" || $method == "PATCH"){
             $id = $this->request->route('id');
             return [
                
                'name'=>[
                    'required',
                     Rule::unique('roles')->ignore($id),

                 ],
                 'display_name'=>[
                    'required',
                     Rule::unique('roles')->ignore($id),

                 ],
                'description'=>[
                    'required',
                 ],
               

            ];
        }else{
            return [


                'name'=>[
                    'required',
                     'unique:roles',

                 ],
                 'display_name'=>[
                    'required',
                    'unique:roles',

                 ],
                'description'=>[
                    'required',
                 ],

            ];
        }
       

        
    }


    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages():array
    {
        return [
            'name.required'=>'请输入名称',
            'name.unique'=>'名称已存在',
           

            'display_name.required'=>'请输入显示名称',
            'display_name.unique'=>'显示名称已存在',

            'description.required'=>'请输入描述',
            
        ];
    }
}
