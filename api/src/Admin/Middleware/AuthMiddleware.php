<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 16:42
 */

namespace App\Admin\Middleware;


use Flexe\Middleware\Middleware;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthMiddleware extends Middleware
{

    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return mixed
     */
    public function __invoke( Request $request, Response $response, $next )
    {
        // TODO: Implement __invoke() method.
    }
}