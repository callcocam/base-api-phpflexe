<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class ResourceController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class ResourceController extends Controller
{

    protected $model = 'ResourceModel';

    protected $table = 'ResourceTable';

    protected $controller = "resource";



}