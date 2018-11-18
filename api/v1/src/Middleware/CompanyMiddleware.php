<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 05/11/2018
 * Time: 13:13
 */

namespace Flexe\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

class CompanyMiddleware extends Middleware
{

    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return mixed
     */
    public function __invoke( Request $request, Response $response, $next )
    {
        if($request->hasHeader('Company-key')):

            $headers = $request->getHeader('Company-key');

            define('COMPANY_KEY',reset($headers));

        else:

            define('COMPANY_KEY','sistema');

        endif;

        return $next($request, $response);
    }
}