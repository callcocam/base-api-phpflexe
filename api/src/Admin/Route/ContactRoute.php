<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\ContactController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ContactController
 * @package App\Admin\Route
 * @Route
 * @Route("/Contact")
 */
class ContactRoute extends RouteAbstract
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

           $this->group("/contact", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ContactController::class))->setName('admin.contact');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ContactController::class))->setName('admin.contact.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ContactController::class))->setName('admin.contact.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ContactController::class))->setName('admin.contact.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ContactController::class))->setName('admin.contact.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ContactController::class))->setName('admin.contact.save');

           });

       });
    }
}