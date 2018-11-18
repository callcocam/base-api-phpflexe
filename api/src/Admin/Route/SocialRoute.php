<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\SocialController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class SocialController
 * @package App\Admin\Route
 * @Route
 * @Route("/Social")
 */
class SocialRoute extends RouteAbstract
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

           $this->group("/social", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",SocialController::class))->setName('admin.social');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",SocialController::class))->setName('admin.social.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",SocialController::class))->setName('admin.social.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",SocialController::class))->setName('admin.social.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",SocialController::class))->setName('admin.social.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",SocialController::class))->setName('admin.social.save');

           });

       });
    }
}