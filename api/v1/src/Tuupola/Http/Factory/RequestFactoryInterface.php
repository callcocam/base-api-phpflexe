<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 13:17
 */

namespace Flexe\Tuupola\Http\Factory;


use Psr\Http\Message\RequestInterface;

interface RequestFactoryInterface
{
    public function createRequest(string $method, $uri): RequestInterface;
}