<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;


use Flexe\Http\Controller;

/**
 * Class GalleryController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class GalleryController extends AbstractController
{

    protected $model = 'GalleryModel';

    protected $table = 'GalleryTable';

    protected $controller = "gallery";



}