<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Controller;

use App\Obras\Model\ConclusoeModel;
use App\Obras\Model\ContratoModel;
use App\Obras\Model\ExecucoeModel;
use App\Obras\Model\LicitacoeModel;
use App\Admin\Model\ImageModel;

/**
 * Class ProjectController
 * @package App\Obras\Controller
 * @Controller
 * @Route("/obras")
 */
class ProjectController extends AbstractController {

    protected $model = 'ProjectModel';
    protected $table = 'ProjectTable';
    protected $controller = "project";

    public function edit($request, $response, $arqs = []) {
        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            $data = $model->find($arqs['id']);

            $result = [];

            if ($data):

                $result = $data->toArray();

                $result['contract'] = ContratoModel::query()->where(['project_id' => $data->id])->first();

                $result['conclusion'] = ConclusoeModel::query()->where(['project_id' => $data->id])->first();

                $result['execution'] = ExecucoeModel::query()->where(['project_id' => $data->id])->first();

                $result['licitacion'] = LicitacoeModel::query()->where(['project_id' => $data->id])->first();

                $result['conclusion']['images'] = ImageModel::query()->where(['assets' => 'conclusoes', 'parent' => $result['conclusion']['id']])->get();

            endif;

            $result['tenant'] = $this->tenant;

            return $response->withJson($result);

        endif;

        return null;
    }

    public function delete($request, $response, $arqs = array()) {

        if ($request->isMethod("DELETE")):

            $model = $this->container->get($this->model);

            if (isset($arqs['id']) && (int) $arqs['id']):

                $data = $model->find($arqs['id']);

                $contract = ContratoModel::query()->where(['project_id' => $arqs['id']])->delete();

                $conclusion = ConclusoeModel::query()->where(['project_id' => $arqs['id']])->delete();

                $execution = ExecucoeModel::query()->where(['project_id' => $arqs['id']])->delete();

                $licitacion = LicitacoeModel::query()->where(['project_id' => $arqs['id']])->delete();

                $conclusion_images = ImageModel::query()->where(['assets' => 'conclusoes', 'parent' => $conclusion['id']])->delete();

            endif;
        endif;

        return parent::delete($request, $response, $arqs);
    }

    public function view($request, $response, $arqs = []) {
        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            $data = $model::query()->where(['alias' => $arqs['id']])->first();

            $result = [];

            if ($data):

                $result['rows'] = $data->toArray();

                $result['contract'] = ContratoModel::query()->where(['project_id' => $data->id])->first();

                $result['conclusion'] = ConclusoeModel::query()->where(['project_id' => $data->id])->first();

                $result['execution'] = ExecucoeModel::query()->where(['project_id' => $data->id])->first();

                $result['licitacion'] = LicitacoeModel::query()->where(['project_id' => $data->id])->first();

                $result['conclusion']['images'] = ImageModel::query()->where(['assets' => 'conclusoes', 'parent' => $result['conclusion']['id']])->get();

            endif;

            $result['tenant'] = $this->tenant;

            return $response->withJson($result);

        endif;

        return null;
    }

}
