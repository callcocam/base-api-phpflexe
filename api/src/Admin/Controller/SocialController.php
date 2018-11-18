<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class SocialController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class SocialController extends Controller
{

    protected $model = 'SocialModel';

    protected $table = 'SocialTable';

    protected $controller = "social";



}