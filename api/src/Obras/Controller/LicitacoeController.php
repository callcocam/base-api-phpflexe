<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Controller;


use Flexe\Http\Controller;

/**
 * Class LicitacoeController
 * @package App\Obras\Controller
 * @Controller
 * @Route("/obras")
 */
class LicitacoeController extends AbstractController
{

    protected $model = 'LicitacoeModel';

    protected $table = 'LicitacoeTable';

    protected $controller = "licitacoe";



}