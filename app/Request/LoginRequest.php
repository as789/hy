<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Contract\TranslatorInterface;

class LoginRequest extends FormRequest
{   


     /**
     * @Inject
     * @var TranslatorInterface
     */
    protected $translator;



    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required'
        ];
    }


    /**
     * 获取已定义验证规则的错误消息
     */
    public function messages(): array
    {
        return [
            'username.required'  => $this->translator->trans('validation.filled',['attribute'=> $this->translator->trans('filled.username')]),
            'password.required'  => $this->translator->trans('validation.filled',['attribute'=> $this->translator->trans('filled.password')]),
            'captcha.required'   => $this->translator->trans('validation.filled',['attribute'=> $this->translator->trans('filled.captcha')])
        ];
    }
}
