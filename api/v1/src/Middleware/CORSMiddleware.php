<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/11/2018
 * Time: 03:46
 */

namespace Flexe\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

class CORSMiddleware extends Middleware
{

    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return mixed
     */
    public function __invoke( Request $request, Response $response, $next )
    {
        $res = $next($request, $response);
        return $res
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With,Company-key, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}