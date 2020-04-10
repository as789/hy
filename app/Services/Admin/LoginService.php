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

namespace App\Services\Admin;




use App\Services\BaseService;

use Hyperf\Di\Annotation\Inject;

use Hyperf\Contract\SessionInterface;

use Hyperf\Validation\ValidationException;

use App\Exception\RequetErrorException;

class LoginService extends BaseService
{   

    /**
     * @Inject()
     * @var SessionInterface
     */
    private  $session;
    
    /**
     * 检查验证码
     * @return [type] [description]
     */
    public function check_captcha($captcha_par){

    	$captcha = $this->session->get('captcha');
    	$captcha = strtolower($captcha);
    	$captcha_par = strtolower($captcha_par);
    	if($captcha_par != $captcha){
    		throw new RequetErrorException("验证码错误",4233);
    	}
        $this->session->forget('captcha');

    }
    
}
