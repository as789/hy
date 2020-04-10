<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Contract\TranslatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Rule;

class AdminRequest extends FormRequest
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
     */
    public function authorize(): bool
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
                
                'username'=>[
                    'required',
                    'regex:/[a-zA-Z0-9]{1,20}/',
                     Rule::unique('admins')->ignore($id),

                 ],
                'email'=>[
                    'required',
                    'regex:/[\w!#$%&\'*+\/=?^_`{|}~-]+(?:\.[\w!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/',
                    Rule::unique('admins')->ignore($id),
                 ],
                'role'=>"required"

            ];
        }else{
            return [

                'username'=>'required|regex:#[a-zA-Z0-9]{1,20}#|unique:admins,username',
                'email'=>['required','regex:/[\w!#$%&\'*+\/=?^_`{|}~-]+(?:\.[\w!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/','unique:admins'],
                'password'=>'required|regex:/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,18}/|confirmed',
                'password_confirmation'=>'required',
                'role'=>"required"

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
            'username.required'=>'请输入用户名',
            'username.unique'=>'用户名已存在',
            'username.regex'=>'请输入1-20位字母或者数字',

            'email.required'=>"请输入邮箱",
            'email.unique'=>"邮箱已存在",
            'email.regex'=>"请输入正确邮箱",

            'password.required'=>'请输入密码',
            'password.regex'=>'请输入6-18位字母和数字的组合',
            'password_confirmation.required'=>'请确认密码',
            'password.confirmed'=>'两次密码不一致',
            'role.required'=>"至少选择一个角色"
        ];
    }
}
