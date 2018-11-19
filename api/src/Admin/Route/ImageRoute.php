<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\ImageController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class ImageController
 * @package App\Admin\Route
 * @Route
 * @Route("/Image")
 */
class ImageRoute extends RouteAbstract
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

           $this->group("/image", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",ImageController::class))->setName('admin.image');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",ImageController::class))->setName('admin.image.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",ImageController::class))->setName('admin.image.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",ImageController::class))->setName('admin.image.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",ImageController::class))->setName('admin.image.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",ImageController::class))->setName('admin.image.save');
                
                $this->map(['POST','OPTIONS'],'/uploads',sprintf("%s:uploads",ImageController::class))->setName('admin.image.uploads');

           });

       });
    }
}