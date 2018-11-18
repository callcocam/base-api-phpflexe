<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class CompanieController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class CompanieController extends Controller
{

    protected $model = 'CompanieModel';

    protected $table = 'CompanieTable';

    protected $controller = "companie";



}