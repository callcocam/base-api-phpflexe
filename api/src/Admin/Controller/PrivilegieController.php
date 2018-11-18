<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class PrivilegieController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class PrivilegieController extends Controller
{

    protected $model = 'PrivilegieModel';

    protected $table = 'PrivilegieTable';

    protected $controller = "privilegie";



}