<?php
namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HyResponseInterface;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Contract\SessionInterface;
use Throwable;



class ValidationExceptionHandler extends  ExceptionHandler
{   

    /**
     * @Inject
     * @var RequestInterface
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
      

        $data =array(

            'code' =>$throwable->status,

            'message'=>$throwable->validator->errors()->first(),

            'data'=>[]

        );

        
        return $this->response->json($data);
    
        
       
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}