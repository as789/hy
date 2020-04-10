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
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Hyperf\Contract\SessionInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Fx\HyperfHttpAuth\Contract\HttpAuthContract;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use App\Request\LoginRequest;
use App\Services\Admin\LoginService;
use App\Exception\RequetErrorException;



class LoginController extends AbstractController
{   

    /**
     * @Inject()
     * @var HttpAuthContract
     */
    protected $auth;


    /**
     * @Inject()
     * @var PhraseBuilder
     */
    protected $phrase;


     /**
     * @Inject()
     * @var CaptchaBuilder
     */
    protected $captcha;


    /**
     * @Inject()
     * @var SessionInterface
     */
    private  $session;

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    
    public function captcha(){

    	
    	$length = config('captcha.length');
    	$width = config('captcha.width');
    	$height = config('captcha.height');
    	$charset = config('captcha.charset');

        $phrase = $this->phrase->build($length, $charset);

        $this->captcha->setPhrase($phrase);

        $this->captcha->build($width, $height);

        $phrase_test = $this->captcha->getPhrase();

        $this->session->set('captcha', $phrase_test);

        $output = $this->captcha->get();
        return $this->response
                        ->withAddedHeader('content-type', 'image/jpeg')
                        ->withBody(new SwooleStream($output));
    }



    /**
     * 登录
     */
    public function showLoginForm()
    {
        
         
        
          echo  $this->auth->guard('admin')->check();
        
        return $this->render->render('admin.login.login');

    }

    /**
     * 登录
     */
    public function login(LoginRequest $request,LoginService $loginser)
    {
        $params = $request->validated();
       
        $loginser->check_captcha($params['captcha']);

        $user = Admin::where('username',$params['username'])->first();
        if(empty($user)){
        	throw new RequetErrorException("账号密码错误",4224);
        }
        
        if(!password_verify($params['password'], $user->password)){

			throw new RequetErrorException("账号密码错误",4224);
        }
        
        $this->auth->guard('admin')->login($user);

        $data =array(

            'code' =>200,

            'message'=>'登录成功',

            'data'=>[]

        );
        return $this->response->withStatus(200)->withBody(new SwooleStream(json_encode($data)));
    }




    /**
     * 登录
     */
    public function loginout()
    {
        $this->session->clear();
         return $this->response->redirect('/admin/login');

    }

}
