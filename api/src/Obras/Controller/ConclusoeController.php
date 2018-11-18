<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Controller;


use Flexe\Http\Controller;

/**
 * Class ConclusoeController
 * @package App\Obras\Controller
 * @Controller
 * @Route("/obras")
 */
class ConclusoeController extends AbstractController
{

    protected $model = 'ConclusoeModel';

    protected $table = 'ConclusoeTable';

    protected $controller = "conclusoe";



}