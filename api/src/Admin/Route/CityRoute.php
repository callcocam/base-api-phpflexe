<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\CityController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class CityController
 * @package App\Admin\Route
 * @Route
 * @Route("/City")
 */
class CityRoute extends RouteAbstract
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

           $this->group("/city", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",CityController::class))->setName('admin.city');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",CityController::class))->setName('admin.city.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",CityController::class))->setName('admin.city.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",CityController::class))->setName('admin.city.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",CityController::class))->setName('admin.city.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",CityController::class))->setName('admin.city.save');

           });

       });
    }
}