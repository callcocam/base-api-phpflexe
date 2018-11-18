<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\UserController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class UserController
 * @package App\Admin\Route
 * @Route
 * @Route("/User")
 */
class UserRoute extends RouteAbstract
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
       $app->group("/api", function (){

           $this->group("/user", function (){

               $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",UserController::class))->setName('api.user');

               $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",UserController::class))->setName('api.user.create');

               $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",UserController::class))->setName('api.user.view');

               $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",UserController::class))->setName('api.user.edit');

               $this->map(['GET','POST','OPTIONS'],'/{id}/delete',sprintf("%s:delete",UserController::class))->setName('api.user.delete');

               $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",UserController::class))->setName('api.user.save');

           });

       });
    }
}