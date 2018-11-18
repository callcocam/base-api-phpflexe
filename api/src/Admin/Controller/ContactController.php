<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class ContactController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class ContactController extends Controller
{

    protected $model = 'ContactModel';

    protected $table = 'ContactTable';

    protected $controller = "contact";



}