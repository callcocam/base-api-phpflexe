<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class AddresController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class AddresController extends Controller
{

    protected $model = 'AddresModel';

    protected $table = 'AddresTable';

    protected $controller = "addres";



}