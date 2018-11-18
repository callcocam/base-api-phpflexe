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
use Flexe\Http\Controller;

/**
 * Class ProjectController
 * @package App\Obras\Controller
 * @Controller
 * @Route("/obras")
 */
class ProjectController extends AbstractController
{

    protected $model = 'ProjectModel';

    protected $table = 'ProjectTable';

    protected $controller = "project";


    public function edit( $request, $response, $arqs = [] )
    {
        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            $data = $model->find($arqs['id']);

            $result = [];
			
			if($data):

			    $result['rows'] = $data->toArray();
				
				$result['contract'] 	= ContratoModel::query()->where(['project_id'=>$data->id])->get();
				
				$result['conclusion'] 	= ConclusoeModel::query()->where(['project_id'=>$data->id])->get();

				$result['execution'] 	= ExecucoeModel::query()->where(['project_id'=>$data->id])->get();

				$result['licitacion'] 	= LicitacoeModel::query()->where(['project_id'=>$data->id])->get();
				
		   endif;
		   
		    $result['tenant'] = $this->tenant;

            return $response->withJson($result);

        endif;

        return null;
    }

	
    public function view( $request, $response, $arqs = [] )
    {
        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            $data = $model::query()->where(['alias'=>$arqs['id']])->first();

            $result = [];
			
			if($data):

			    $result['rows'] = $data->toArray();
				
				$result['contract'] 	= ContratoModel::query()->where(['project_id'=>$data->id])->get();
				
				$result['conclusion'] 	= ConclusoeModel::query()->where(['project_id'=>$data->id])->get();

				$result['execution'] 	= ExecucoeModel::query()->where(['project_id'=>$data->id])->get();

				$result['licitacion'] 	= LicitacoeModel::query()->where(['project_id'=>$data->id])->get();
				
		   endif;
		   
		   $result['tenant'] = $this->tenant;
		   
            return $response->withJson($result);

        endif;

        return null;
    }
}