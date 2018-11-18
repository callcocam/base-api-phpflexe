<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 05/11/2018
 * Time: 00:26
 */

namespace Flexe\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

class OptionsMiddleware extends Middleware
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

        if($request->isMethod('OPTIONS')):
            $response->withStatus(200)
                ->withHeader("Content-Type", "application/json")
                ->withJson([]);
        endif;

        return $res;
    }
}