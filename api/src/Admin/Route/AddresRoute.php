<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\AddresController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class AddresController
 * @package App\Admin\Route
 * @Route
 * @Route("/Addres")
 */
class AddresRoute extends RouteAbstract
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

           $this->group("/addres", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",AddresController::class))->setName('admin.addres');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",AddresController::class))->setName('admin.addres.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",AddresController::class))->setName('admin.addres.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",AddresController::class))->setName('admin.addres.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",AddresController::class))->setName('admin.addres.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",AddresController::class))->setName('admin.addres.save');

           });

       });
    }
}