<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 05/09/2018
 * Time: 19:00
 */

namespace Flexe\Table\Sources;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends AbstractSource
{

    /**
     * AbstractSource constructor.
     * @param $source Model
     * @param $table
     */
    public function __construct($source, $table)
    {
        $this->source = $source;

        $this->select = $source::query();

        $this->table = $table;

    }

    protected function order()
    {
        $column = $this->getParams()->column;

        $order = $this->getParams()->order;

        if(!$column):

            $this->select->orderBy("id", $order);

        endif;

        $this->select->orderBy($column, $order);

    }

    protected function quickSearch()
    {

        $anyKeyword = $this->getParams()->search;

        $headers = $this->table->getHeaders();
		
		
		if($this->getParams()->status):

		$this->select->where([$this->table->getOptions()->status => $this->getParams()->status]);

		endif;

        $Searchs = [];

        if($headers):
		
            foreach ($headers as $values):

                if (isset($values['name'])):

                    if ($values['alias']):
					
                        $Searchs[] = $values['name'];


                    endif;
                endif;

            endforeach;

        endif;



        if($Searchs):

            $Search = implode(",", $Searchs);

            if($anyKeyword):

                $this->select->where( DB::raw("CONCAT_WS(' ', {$Search})"),"like", "%{$anyKeyword}%");

            endif;

        endif;

        $between = $this->getParams()->between;

        $number = $this->getParams()->number;

        if($between):

            /**
             * Seleção entre datas
             */
            if(method_exists($this, $between)):

                $this->$between($this->select, $number);

            endif;

        endif;

        if (defined('COMPANYS_ID')) {

            $this->select->where(["company_id"=>COMPANYS_ID]);

        }

		
	   
        $this->total = $this->select->count();

        $this->select->forPage($this->getParams()->page, $this->getParams()->limit);

    }

    public function getData()
    {
        $this->initQuery();

        //var_dump($this->select->toSql());
        $this->data =$this->select->get();

        $this->getParams()->total = collect($this->data->toArray())->count();

        return $this->data;
    }
}