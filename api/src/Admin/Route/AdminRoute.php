<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 00:40
 */

namespace App\Admin\Route;


use App\Admin\Controller\AdminController;
use Flexe\RouteAbstract;
use Slim\App;

class AdminRoute extends RouteAbstract
{

    /**
     * RouteAbstract constructor.
     * @param App $app
     */
    public function __construct( App $app )
    {
        /** @var App $app */
        $this->create($app);
    }

    /**
     * @param $app
     * @return mixed
     */
    public function create( App $app )
    {

        $app->get('[/]',sprintf("%s:index",AdminController::class));

    }
}