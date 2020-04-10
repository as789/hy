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

use Hyperf\HttpServer\Router\Router;
use \App\Middleware\AuthenticateMiddleware;
use \App\Middleware\AuthMiddleware;

    Router::addGroup('/admin/',function () {
        
        
        Router::addGroup('',function () {
    	   Router::get('login', 'App\Controller\Admins\LoginController@showLoginForm');
           Router::post('login', 'App\Controller\Admins\LoginController@login');
           Router::get('captcha', 'App\Controller\Admins\LoginController@captcha');
        },['middleware' => 
            [AuthMiddleware::class]
        ]);
        
        
        Router::addGroup('',function () {

			Router::get('home', 'App\Controller\Admins\IndexController@home');
			Router::get('homeIni', 'App\Controller\Admins\IndexController@homeIni');
			Router::get('index', 'App\Controller\Admins\IndexController@index');
			Router::get('loginout', 'App\Controller\Admins\LoginController@loginout');

            //用户管理
            Router::addGroup('admin',function () {
                Router::get('/list', 'App\Controller\Admins\AdminController@list');
                Router::get('/', 'App\Controller\Admins\AdminController@index');
			    Router::get('/create', 'App\Controller\Admins\AdminController@create');
			    Router::post('/', 'App\Controller\Admins\AdminController@store');
			    Router::get('/{id}', 'App\Controller\Admins\AdminController@show');
			    Router::get('/{id}/edit', 'App\Controller\Admins\AdminController@edit');
	            Router::addRoute(['PUT','PATCH'],'/{id}','App\Controller\Admins\AdminController@update');
			    Router::delete('/{id}', 'App\Controller\Admins\AdminController@destroy');

            });


            //角色管理
            Router::addGroup('role',function () {
                Router::get('/list', 'App\Controller\Admins\RoleController@list');
                Router::get('/', 'App\Controller\Admins\RoleController@index');
			    Router::get('/create', 'App\Controller\Admins\RoleController@create');
			    Router::post('/', 'App\Controller\Admins\RoleController@store');
			    Router::get('/{id}', 'App\Controller\Admins\RoleController@show');
			    Router::get('/{id}/edit', 'App\Controller\Admins\RoleController@edit');
	            Router::addRoute(['PUT','PATCH'],'/{id}','App\Controller\Admins\RoleController@update');
			    Router::delete('/{id}', 'App\Controller\Admins\RoleController@destroy');

            });


            //权限管理
            Router::addGroup('permission',function () {
                Router::get('/list', 'App\Controller\Admins\PermissionController@list');
                Router::get('/', 'App\Controller\Admins\PermissionController@index');
			    Router::get('/create', 'App\Controller\Admins\PermissionController@create');
			    Router::post('/', 'App\Controller\Admins\PermissionController@store');
			    Router::get('/{id}', 'App\Controller\Admins\PermissionController@show');
			    Router::get('/{id}/edit', 'App\Controller\Admins\PermissionController@edit');
	            Router::addRoute(['PUT','PATCH'],'/{id}','App\Controller\Admins\PermissionController@update');
			    Router::delete('/{id}', 'App\Controller\Admins\PermissionController@destroy');

            });

	    },['middleware' =>

	    	 [AuthenticateMiddleware::class]
	    ]);
    });

