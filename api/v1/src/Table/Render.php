<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 05/09/2018
 * Time: 11:23
 */

namespace Flexe\Table;


class Render extends AbstractElement
{

    protected $options = [];

    private $param = [];

    public function __construct(AbstractTable $table)
    {

        $this->setTable($table);

        $this->options = $this->getTable()->getOptions();

        $this->param = $this->getTable()->getParams();

        $this->param->init();
    }

    /**
     * Rendering head
     *
     * @return string
     */
    public function renderHead()
    {
        $headers = $this->getTable()->getHeaders();

        return $headers;
    }

    public function json(){

        $data = $this->getTable()->getRow()->renderRow('array_assc');

        $this->paramsWrap();
        
        $this->params($data);

        return $this->variables;
    }


    private function params($data){

        $this->setVariable('options',$this->options);

        $this->setVariable('params',$this->param);

        $this->setVariable('headers',$this->getTable()->getHeaders());

        $this->setVariable('rows',$data);

    }

    private function paramsWrap(){

        $paramsWrap['title'] = $this->options->title;
        $paramsWrap['totalItems'] = $this->getTable()->getSource()->getTotal();
        $paramsWrap['status'] = $this->param->status;
        $paramsWrap['start'] = $this->param->start;
        $paramsWrap['end'] = $this->param->end;
        $paramsWrap['column'] = $this->param->column;
        $paramsWrap['order'] = $this->param->order;
        $paramsWrap['limit'] = $this->param->limit;
        $paramsWrap['page'] = $this->param->page;
        $paramsWrap['between'] = $this->param->between;
        $paramsWrap['offSet'] = ($this->param->page * $this->param->limit) - $this->param->limit;
        $paramsWrap['search'] = $this->param->search;

        $this->setVariable('paramsWrap',$paramsWrap);


        $this->param->offset = ($this->param->page * $this->param->limit) - $this->param->limit;

    }


}