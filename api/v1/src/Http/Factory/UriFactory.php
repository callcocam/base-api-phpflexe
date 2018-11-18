<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 16:36
 */

namespace Flexe\Http\Factory;

use Slim\Http\Uri as SlimUri;

use Psr\Http\Message\UriInterface;

final class UriFactory implements UriFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createUri(string $uri = ""): UriInterface
    {

        if (class_exists(SlimUri::class)) {
            if (false === parse_url($uri)) {
                throw new \InvalidArgumentException("Invalid URI: $uri");
            }
            return SlimUri::createFromString($uri);
        }


        throw new \RuntimeException("No PSR-7 implementation available");
    }
}
