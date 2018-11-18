<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 01:50
 */

namespace Flexe;


use Slim\App;

abstract class RouteAbstract
{

    /**
     * RouteAbstract constructor.
     * @param App $app
     */
    abstract public function __construct( App$app);

    /**
     * @param $app
     * @return mixed
     */
    abstract public function create( App $app);


}