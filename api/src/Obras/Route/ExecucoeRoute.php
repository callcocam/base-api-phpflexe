<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Route;


use App\Obras\Controller\ExecucoeController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ExecucoeController
 * @package App\Obras\Route
 * @Route
 * @Route("/Execucoe")
 */
class ExecucoeRoute extends RouteAbstract
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

           $this->group("/execucoe", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ExecucoeController::class))->setName('obras.execucoe');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ExecucoeController::class))->setName('obras.execucoe.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ExecucoeController::class))->setName('obras.execucoe.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ExecucoeController::class))->setName('obras.execucoe.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ExecucoeController::class))->setName('obras.execucoe.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ExecucoeController::class))->setName('obras.execucoe.save');

           });

       });
    }
}