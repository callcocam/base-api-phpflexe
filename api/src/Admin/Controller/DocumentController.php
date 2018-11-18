<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class DocumentController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class DocumentController extends Controller
{

    protected $model = 'DocumentModel';

    protected $table = 'DocumentTable';

    protected $controller = "document";



}