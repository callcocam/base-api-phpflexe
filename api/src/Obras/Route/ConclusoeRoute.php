<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Route;


use App\Obras\Controller\ConclusoeController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ConclusoeController
 * @package App\Obras\Route
 * @Route
 * @Route("/Conclusoe")
 */
class ConclusoeRoute extends RouteAbstract
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

           $this->group("/conclusoe", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ConclusoeController::class))->setName('obras.conclusoe');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ConclusoeController::class))->setName('obras.conclusoe.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ConclusoeController::class))->setName('obras.conclusoe.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ConclusoeController::class))->setName('obras.conclusoe.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ConclusoeController::class))->setName('obras.conclusoe.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ConclusoeController::class))->setName('obras.conclusoe.save');
                
                $this->map(['POST','OPTIONS'],'/uploads',sprintf("%s:uploads",ConclusoeController::class))->setName('obras.conclusoe.uploads');

           });

       });
    }
}