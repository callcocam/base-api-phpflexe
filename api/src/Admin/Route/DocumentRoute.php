<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\DocumentController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class DocumentController
 * @package App\Admin\Route
 * @Route
 * @Route("/Document")
 */
class DocumentRoute extends RouteAbstract
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

           $this->group("/document", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",DocumentController::class))->setName('admin.document');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",DocumentController::class))->setName('admin.document.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",DocumentController::class))->setName('admin.document.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",DocumentController::class))->setName('admin.document.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",DocumentController::class))->setName('admin.document.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",DocumentController::class))->setName('admin.document.save');

           });

       });
    }
}