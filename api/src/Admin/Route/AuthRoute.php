<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 11:32
 */

namespace App\Admin\Route;


use App\Admin\Controller\AuthController;
use Flexe\RouteAbstract;
use Slim\App;

class AuthRoute extends RouteAbstract
{

    /**
     * RouteAbstract constructor.
     * @param App $app
     */
    public function __construct( App $app )
    {
        $this->create($app);
    }

    /**
     * @param $app
     * @return mixed
     */
    public function create( App $app )
    {
        $app->group("/api", function () {

            $this->group("/auth", function () {

                $this->map(['POST','OPTIONS'],'/login', sprintf("%s:login", AuthController::class));
                $this->map(['POST','OPTIONS'],'/forgot-password', sprintf("%s:forgot", AuthController::class));
                $this->map(['POST','OPTIONS'],'/register', sprintf("%s:register", AuthController::class));
                $this->map(['GET','OPTIONS'],'/token', sprintf("%s:token", AuthController::class));

            });
        });
    }
}