<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Route;


use App\Obras\Controller\ContratoController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ContratoController
 * @package App\Obras\Route
 * @Route
 * @Route("/Contrato")
 */
class ContratoRoute extends RouteAbstract
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

           $this->group("/contrato", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ContratoController::class))->setName('obras.contrato');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ContratoController::class))->setName('obras.contrato.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ContratoController::class))->setName('obras.contrato.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ContratoController::class))->setName('obras.contrato.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ContratoController::class))->setName('obras.contrato.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ContratoController::class))->setName('obras.contrato.save');

           });

       });
    }
}