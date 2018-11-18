<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\RoleController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class RoleController
 * @package App\Admin\Route
 * @Route
 * @Route("/Role")
 */
class RoleRoute extends RouteAbstract
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

           $this->group("/role", function (){

               $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",RoleController::class))->setName('api.role');

               $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",RoleController::class))->setName('api.role.create');

               $this->map(['GET','OPTIONS'],'/select/{index}/{name}[/{id}]',sprintf("%s:select",RoleController::class))->setName('api.role.select');

               $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",RoleController::class))->setName('api.role.view');

               $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",RoleController::class))->setName('api.role.edit');

               $this->map(['GET','POST','OPTIONS'],'/{id}/delete',sprintf("%s:delete",RoleController::class))->setName('api.role.delete');

               $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",RoleController::class))->setName('api.role.save');

           });

       });
    }
}