<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 03:16
 */

namespace Flexe\Http;


use Carbon\Exceptions\InvalidDateException;
use Flexe\Http\Traits\Get;
use Flexe\Http\Traits\ParamsTrait;
use Flexe\Model\Db;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Carbon\Carbon;

abstract class Controller
{

    use ParamsTrait;

    protected $route = 'admin';

    protected $controller = 'admin';

    protected $action = "stores";

    protected $model;

    protected $table;
    /**
     * @var ContainerInterface
     */
    protected $container;
    protected $alias = 'name';

    public function __construct( ContainerInterface $container)
    {
        $this->container = $container;

        $this->rq = $container->get('request');


        $this->tenant = $container->get('tenant')->getCompany();
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function stores( $request, $response, $arqs = []){

        if ($request->isMethod("GET")):
            $model = $this->container->get($this->model);

            $table = $this->container->get($this->table);

            $data = $table->setSource($model)->setParams(array_filter($this->get()))->render();

            $data['tenant'] = $this->tenant;

            return $response->withJson($data);
        endif;

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->withJson([]);

    }
	
	/**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function search( $request, $response, $arqs = []){

        if ($request->isMethod("GET")):
            $model = $this->container->get($this->model);

            $table = $this->container->get($this->table);
			
			$params = array_filter($this->get());

			$result = $model::query()->select('name')->where($params['key'], 'like', '%' . $params['value'] . '%')->get();
           
		    $data['rows'] = [];
		   
			if($result):
			
				$data['rows'] = array_values($result->toArray());
			
			endif;

            $data['tenant'] = $this->tenant;

            return $response->withJson($data);
        endif;

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->withJson([]);

    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function view($request,$response, $arqs = []){

        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            return $response->withJson($model->find($arqs['id']));

        endif;

        return null;
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function select($request,$response, $arqs = []){


        if ($request->isMethod("GET")):


            $model = $this->container->get($this->model);

            if(isset($arqs['id']) && (int)$arqs['id']){

                $data['rows'][] = $model->select(sprintf('%s as id',$arqs['index']),sprintf('%s as text',$arqs['name']))->find($arqs['id']);

            }
            else{

                $data['rows'] = $model->select(sprintf('%s as id',$arqs['index']),sprintf('%s as text',$arqs['name']))->get();

            }

            $data['tenant'] = $this->tenant;
            $data['results'] = $data['rows'];

            return $response->withJson($data);
        endif;

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->withJson([]);
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function create($request,$response, $arqs = []){

        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            return $response->withJson($model->find($arqs['id']));

        endif;

        return null;

    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function edit($request,$response, $arqs = []){

        if ($request->isMethod("GET")):

            $model = $this->container->get($this->model);

            $data = $model->find($arqs['id']);

            $result = [];

            if($data):

                foreach($data->toArray() as $key => $value):

//                    if($key == "created_at" || $key == "updated_at"):
//
//                        $result[$key] = $this->dateFormat($value);
//
//                    else:
//
//                        $result[$key] = $value;
//
//                    endif;

                    $result[$key] = $value;

                endforeach;

            endif;

            $result['tenant'] = $this->tenant;

            return $response->withJson($result);

        endif;

        return null;
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function delete($request,$response, $arqs = []){

        if ($request->isMethod("DELETE")):
            /**
             * @var $model Db
             */
            $model = $this->container->get($this->model);

            $data['result'] = false;

            if(isset($arqs['id']) && (int)$arqs['id']):

                $data = $model->find($arqs['id']);

                $data['result'] = $data->delete();

                $data['error'] = 'Não foi possivel excluir o cadstro!';

                if($data['result']):

                    $data['error'] = 'Cadastro excluido com sucesso!';

                endif;

            endif;

            $data['tenant'] = $this->tenant;

            return $response->withJson($data);

        endif;

        return null;

    }

    /**
     * @param $request Request
     * @param $response Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function save($request,$response, $arqs = []){

        if ($request->isMethod("POST")):
            /**
             * @var $model Db
             */
            $model = $this->container->get($this->model);

            $data['result'] = false;
            $image =  $this->image();
            if($image):

                $dataFiles = array_merge($this->post(),$image);

            else:

                $dataFiles = $this->post();

            endif;

            if(!isset($dataFiles['status']) && !(int)$dataFiles['status']):
                $dataFiles['status'] = 0;
            else:
                $dataFiles['status'] = 1;
            endif;

            if(isset($dataFiles['type'])):
                if(!(int)$dataFiles['type']):
                    $dataFiles['type'] = 0;
                else:
                    $dataFiles['type'] = 1;
                endif;
            endif;

			$dataFiles['updated_at'] = date("Y-m-d H:i:s");

            if(isset($dataFiles['alias'])):

                $dataFiles['alias'] = str_slug($dataFiles[$this->alias]);

            endif;
            if(isset($dataFiles['slug'])):

                $dataFiles['slug'] = str_slug($dataFiles[$this->alias]);

            endif;

            if(isset($dataFiles['id']) && (int)$dataFiles['id']):

                $id = $dataFiles['id'];

                unset($dataFiles['id'],$dataFiles['created_at']);

                $data['result'] =   $model::query()->where(['id'=>$id])->update($dataFiles);

                $data['error'] = 'Não foi possivel atualizar o cadstro!';

                if($data['result']):

                    $data['error'] = 'Cadastro atualizado com sucesso!';

                endif;

            else:
			
				$dataFiles['created_at'] = date("Y-m-d H:i:s");
				
                $data['result'] =  $model::query()->insertGetId($dataFiles);

                $data['error'] = 'Não foi possivel finalizar o cadstro!';

                if($data['result']):

                    $data['error'] = 'Cadastro inserido com sucesso!';

                endif;

            endif;

            $data['tenant'] = $this->tenant;

            return $response->withJson($data);

        endif;

        return null;
    }

    protected function dateFormat($context,$format='d/m/Y H:i:s',$type=true){

        $valid = $this->isValidDateTimeString($context,$format);

        if($valid){

            return Carbon::createFromTimestamp($context)->format($format);

        }
		if($type){
         return date($format);
		}

    }
    private function isValidDateTimeString($str_dt, $str_dateformat) {
        $date = \DateTime::createFromFormat($str_dateformat, $str_dt, new \DateTimeZone(date_default_timezone_get()));
        return $date && $date->format($str_dateformat) == $str_dt;
    }

}