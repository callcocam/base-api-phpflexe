<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 10:40
 */

namespace Flexe\Providers;


use Slim\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
class DBProvider
{
    public static function register( Container $container )
    {
        // eloquent
        $container['db'] = function ($c) {
            $capsule = new Capsule();
            $capsule->addConnection($c['settings']['db']);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return $capsule;
        };

        $container['db'];

        return $container;
    }
}