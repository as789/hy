<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Middleware;

use Hyperf\Di\Annotation\Inject;
use Fx\HyperfHttpAuth\Exception\AuthenticationException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Fx\HyperfHttpAuth\Contract\HttpAuthContract;
use Hyperf\View\RenderInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HyResponseInterface;
use App\Exception\AuthErrorException;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Fx\HyperfHttpAuth\Contract\HttpAuthContract
     */
    protected $auth;

     /**
     * @Inject
     * @var HyResponseInterface
     */
    protected $response;



    /**
     * AuthenticateMiddleware constructor.
     */
    public function __construct(ContainerInterface $container, HttpAuthContract $auth)
    {
        $this->container = $container;
        $this->auth = $auth;

    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->authenticate($request, $this->guards());

        return $handler->handle($request);
    }

    protected function authenticate(ServerRequestInterface $request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }
         
         
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {

                if($guard =="admin"){
                     throw new AuthErrorException("",5601); 
                }
            }
        }
    }

    protected function guards(): array
    {
        return ['admin','home'];
    }
}
