<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\ResourceController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ResourceController
 * @package App\Admin\Route
 * @Route
 * @Route("/Resource")
 */
class ResourceRoute extends RouteAbstract
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

           $this->group("/resource", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ResourceController::class))->setName('admin.resource');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ResourceController::class))->setName('admin.resource.create');

                $this->map(['GET','OPTIONS'],'/select/{index}/{name}[/{id}]',sprintf("%s:select",ResourceController::class))->setName('api.resource.select');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ResourceController::class))->setName('admin.resource.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ResourceController::class))->setName('admin.resource.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ResourceController::class))->setName('admin.resource.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ResourceController::class))->setName('admin.resource.save');

           });

       });
    }
}