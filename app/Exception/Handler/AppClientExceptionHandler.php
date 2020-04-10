<?php

declare(strict_types = 1);

namespace App\Exception\Handler;

use Hyperf\Di\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Throwable;
use App\Exception;

class AppClientExceptionHandler extends ExceptionHandler
{

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
       

        $data =array(

            'code' =>$throwable->getCode(),

            'message'=>$throwable->getMessage(),

            'data'=>[]

        );
        return $response->withStatus(200)->withBody(new SwooleStream(json_encode($data)));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof Exception\RequetErrorException;
               
    }

}
