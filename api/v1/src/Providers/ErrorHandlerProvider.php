<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 10:25
 */

namespace Flexe\Providers;


use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Slim\Container;

class ErrorHandlerProvider
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     * @return Container
     */
    public static function register( Container $container )
    {

        /**
         * Serviço de Logging em Arquivo
         */
        $container['logger'] = function($container) {
            $settings = $container->get('settings')['logger'];
            $logger = new Logger($settings['name']);
            $logfile = sprintf('%s/logs/%s.log',APP_DIR,$settings['path']);
            $stream = new StreamHandler($logfile, $settings['level']);
            $fingersCrossed = new FingersCrossedHandler(
                $stream, Logger::INFO);
            $logger->pushHandler($fingersCrossed);

            return $logger;
        };

        /**
         * Converte os Exceptions Genéricas dentro da Aplicação em respostas JSON
         */
        $container['errorHandler'] = function () use ($container) {
            return function ($request, $response, $exception) use ($container) {
                $arrayJson = [ "code" => $exception->getCode(), "message" => 'Something went wrong! Cause: ' . $exception->getMessage()];

                return $container['response']->withStatus(500)
                    ->withHeader('Content-Type', 'Application/json')
                    ->withJson($arrayJson);
            };
        };

        $container['phpErrorHandler'] = function () use ($container) {
            return function ($request, $response, $exception) use ($container) {
                $arrayJson = [ "code" => $exception->getCode(), "message" => 'Something went wrong! Cause: ' . $exception->getMessage()];

                return $container['response']->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->withJson($arrayJson);
            };
        };
        /**
         * Converte os Exceptions de Erros 404 - Not Found
         */
        $container['notFoundHandler'] = function ($c) {
            return function ($request, $response) use ($c) {
                return $c['response']->withStatus(404)
                    ->withHeader('Content-Type', 'Application/json')
                    ->withJson('Page not found');
            };
        };
        /**
         * Converte os Exceptions de Erros 405 - Not Allowed
         */
        $container['notAllowedHandler'] = function ($c) {
            return function ($request, $response, $methods) use ($c) {
                return $c['response']
                    ->withStatus(405)
                    ->withHeader('Allow', implode(', ', $methods))
                    ->withHeader('Content-Type', 'Application/json')
                    ->withJson('Method must be one of: ' . implode(', ', $methods));
            };
        };



        return $container;
    }
}