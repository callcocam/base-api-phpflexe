<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class CityController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class CityController extends Controller
{

    protected $model = 'CityModel';

    protected $table = 'CityTable';

    protected $controller = "city";



}