<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Controller;


use Flexe\Http\Controller;

/**
 * Class ContratoController
 * @package App\Obras\Controller
 * @Controller
 * @Route("/obras")
 */
class ContratoController extends AbstractController
{

    protected $model = 'ContratoModel';

    protected $table = 'ContratoTable';

    protected $controller = "contrato";

    public function edit( $request, $response, $arqs = [] )
    {
        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            $data = $model->find($arqs['id']);

            $result = [];

            if($data):

                foreach($data->toArray() as $key => $value):

                    if($key == "created_at" || $key == "updated_at"):

                        $result[$key] = $this->dateFormat($value);

                    else:

                        $result[$key] = $value;

                    endif;

                endforeach;

            endif;

            $result['tenant'] = $this->tenant;

            return $response->withJson($result);

        endif;

        return null;
    }

}