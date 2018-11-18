<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 13:15
 */

namespace Flexe\Tuupola\Http\Factory;


use Psr\Http\Message\ResponseInterface;

interface ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reason = ""): ResponseInterface;
}