<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Controller;
use App\Admin\Model\ImageModel;

/**
 * Class ImageController
 * @package App\Admin\Controller
 * @Controller
 * @Route("/admin")
 */
class ImageController extends AbstractController {

    protected $model = 'ImageModel';
    protected $table = 'ImageTable';
    protected $controller = "image";

    public function delete($request, $response, $arqs = array()) {
       
        if ($request->isMethod("DELETE")):
            /**
             * @var $model Db
             */
            $model = $this->container->get($this->model);

            $data['result'] = false;

            if (isset($arqs['id']) && (int) $arqs['id']):

                $data = $model->find($arqs['id']);

                $data['result'] = $data->delete();

                $data['error'] = 'Não foi possivel excluir o cadstro!';

                if ($data['result']):

                    $data['error'] = 'Cadastro excluido com sucesso!';

                endif;

            endif;

            $data['images'] = ImageModel::query()->where(['assets'=>$data['assets'],'parent'=>$data['parent']])->get();
             
            $data['tenant'] = $this->tenant;

            return $response->withJson($data);

        endif;

        return null;
    }

}
