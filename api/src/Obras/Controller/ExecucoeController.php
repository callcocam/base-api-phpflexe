<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Controller;


use Flexe\Http\Controller;

/**
 * Class ExecucoeController
 * @package App\Obras\Controller
 * @Controller
 * @Route("/obras")
 */
class ExecucoeController extends AbstractController
{

    protected $model = 'ExecucoeModel';

    protected $table = 'ExecucoeTable';

    protected $controller = "execucoe";



}