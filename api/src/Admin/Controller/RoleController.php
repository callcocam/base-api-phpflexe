<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


/**
 * Class RoleController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class RoleController extends AbstractController
{

    protected $model = 'RoleModel';

    protected $table = 'RoleTable';

    protected $controller = "role";


    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $args
     * @Get(name="admin.role")
     */
    public function index( $request, $response, $args = []) {

        echo "Up Slim " . \Flexe\App::getVersion();
    }
}