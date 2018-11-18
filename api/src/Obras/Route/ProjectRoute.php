<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Route;


use App\Obras\Controller\ProjectController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ProjectController
 * @package App\Obras\Route
 * @Route
 * @Route("/Project")
 */
class ProjectRoute extends RouteAbstract
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

           $this->group("/project", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ProjectController::class))->setName('obras.project');
				
                $this->map(['GET','OPTIONS'],'/search',sprintf("%s:search",ProjectController::class))->setName('obras.project.search');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ProjectController::class))->setName('obras.project.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ProjectController::class))->setName('obras.project.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ProjectController::class))->setName('obras.project.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ProjectController::class))->setName('obras.project.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ProjectController::class))->setName('obras.project.save');

           });

       });
    }
}