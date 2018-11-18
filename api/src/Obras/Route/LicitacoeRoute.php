<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Route;


use App\Obras\Controller\LicitacoeController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class LicitacoeController
 * @package App\Obras\Route
 * @Route
 * @Route("/Licitacoe")
 */
class LicitacoeRoute extends RouteAbstract
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

           $this->group("/licitacoe", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",LicitacoeController::class))->setName('obras.licitacoe');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",LicitacoeController::class))->setName('obras.licitacoe.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",LicitacoeController::class))->setName('obras.licitacoe.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",LicitacoeController::class))->setName('obras.licitacoe.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",LicitacoeController::class))->setName('obras.licitacoe.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",LicitacoeController::class))->setName('obras.licitacoe.save');

           });

       });
    }
}