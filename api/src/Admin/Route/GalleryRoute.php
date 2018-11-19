<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\GalleryController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class GalleryController
 * @package App\Admin\Route
 * @Route
 * @Route("/Gallery")
 */
class GalleryRoute extends RouteAbstract
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

           $this->group("/gallery", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",GalleryController::class))->setName('admin.gallery');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",GalleryController::class))->setName('admin.gallery.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",GalleryController::class))->setName('admin.gallery.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",GalleryController::class))->setName('admin.gallery.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",GalleryController::class))->setName('admin.gallery.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",GalleryController::class))->setName('admin.gallery.save');

           });

       });
    }
}