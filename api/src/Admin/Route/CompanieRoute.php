<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Route;


use App\Admin\Controller\CompanieController;
use Flexe\RouteAbstract;
use Slim\App;

/**
 * Class CompanieController
 * @package App\Admin\Route
 * @Route
 * @Route("/Companie")
 */
class CompanieRoute extends RouteAbstract
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

           $this->group("/companie", function (){

                $this->map(['GET','OPTIONS'],'[/]',sprintf("%s:stores",CompanieController::class))->setName('admin.companie');

                $this->map(['GET','OPTIONS'],'/create',sprintf("%s:create",CompanieController::class))->setName('admin.companie.create');

                $this->map(['GET','OPTIONS'],'/{id}/view',sprintf("%s:view",CompanieController::class))->setName('admin.companie.view');

                $this->map(['GET','OPTIONS'],'/{id}/edit',sprintf("%s:edit",CompanieController::class))->setName('admin.companie.edit');

                $this->map(['DELETE','OPTIONS'],'/{id}/delete',sprintf("%s:delete",CompanieController::class))->setName('admin.companie.delete');

                $this->map(['POST','OPTIONS'],'/save',sprintf("%s:save",CompanieController::class))->setName('admin.companie.save');

           });

       });
    }
}