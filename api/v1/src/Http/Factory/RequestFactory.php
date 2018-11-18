<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 15:45
 */

namespace Flexe\Http\Factory;

use Slim\Http\Request as SlimRequest;
use Slim\Http\Uri as SlimUri;
use Slim\Http\Headers as SlimHeaders;

use Psr\Http\Message\RequestInterface;

class RequestFactory implements RequestFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createRequest(string $method, $uri): RequestInterface
    {

        if (class_exists(SlimRequest::class)) {
            $uri = SlimUri::createFromString($uri);
            $headers = new SlimHeaders;
            $body = (new StreamFactory)->createStream("");
            return new SlimRequest($method, $uri, $headers, [], [], $body);
        }



        throw new \RuntimeException("No PSR-7 implementation available");
    }
}