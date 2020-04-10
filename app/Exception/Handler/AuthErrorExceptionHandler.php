<?php

declare(strict_types = 1);

namespace App\Exception\Handler;

use Hyperf\Di\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Throwable;
use App\Exception;
use Hyperf\View\RenderInterface;
use Hyperf\HttpServer\Contract\RequestInterface as HyRequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HyResponseInterface;

class AuthErrorExceptionHandler extends ExceptionHandler
{
    
    /**
     * @Inject
     * @var RenderInterface
     */
    protected $render;
     /**
     * @Inject
     * @var HyRequestInterface
     */
    protected $request;

     /**
     * @Inject
     * @var HyResponseInterface
     */
    protected $response;


    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
       
        $errors = array(

        	'code' =>$throwable->getCode(),
            'message'=>$throwable->getMessage(),
            'data'=>[]
        );
        if($throwable->getCode() == 5600){
        	return $this->render->render('admin.login.login',compact('errors'));
        }elseif($throwable->getCode() == 5601){
        	return $this->response->redirect('/admin/home');
        }
       

        
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof Exception\AuthErrorException;
               
    }

}
