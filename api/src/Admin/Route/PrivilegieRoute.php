<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\PrivilegieController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class PrivilegieController
 * @package App\Admin\Route
 * @Route
 * @Route("/Privilegie")
 */
class PrivilegieRoute extends RouteAbstract
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

           $this->group("/privilegie", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",PrivilegieController::class))->setName('admin.privilegie');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",PrivilegieController::class))->setName('admin.privilegie.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",PrivilegieController::class))->setName('admin.privilegie.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",PrivilegieController::class))->setName('admin.privilegie.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",PrivilegieController::class))->setName('admin.privilegie.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",PrivilegieController::class))->setName('admin.privilegie.save');

           });

       });
    }
}