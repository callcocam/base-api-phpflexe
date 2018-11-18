<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 16:34
 */

namespace Flexe\Http\Factory;


use Slim\Http\Response as SlimResponse;

use Psr\Http\Message\ResponseInterface;

final class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createResponse(int $code = 200, string $reason = ""): ResponseInterface
    {


        if (class_exists(SlimResponse::class)) {
            return new SlimResponse($code);
        }

        throw new \RuntimeException("No PSR-7 implementation available");
    }
}
