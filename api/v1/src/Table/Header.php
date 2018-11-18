<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 03/09/2018
 * Time: 09:17
 */

namespace Flexe\Table;


class Header extends AbstractElement
{


    protected $defaults= [
			'index'=>'',
			'name'=>'',
			'title'=>'',
			'width'=>'',
			'order'=>true,
			'format'=>'',
			'alias'=>true,
			'classe'=>'',
			'icone'=>'',
			'sortable'=>true,
	];

    protected $options=[];

    protected $index = '';

    protected $name = '';
	
    protected $format = 'default';

    protected $classe = '';

    protected $icone = '';

    protected $headers =[];

    protected $title = '';

    protected $width = '';

    protected $order = true;

    protected $alias = '';

    protected $cell;

    protected $sortable = true;

    protected static $orderReverse = [
        'asc' => 'desc',
        'desc' => 'asc'
    ];


    public function __construct($table, $index, $headers)
    {

       $this->index = $index;

        $this->headers = $headers;

        $this->cell = new Cell($this);

        $this->cell->setTable($table);

        $this->setTable($table);

        $this->init();

    }

    private function init(){

        if($this->headers):

            foreach ($this->headers as $name => $header):

                $this->options[$name] = array_merge($this->defaults,$header);

            endforeach;

        endif;
		
    }

    /**
     * @return Cell
     */
    public function getCell(): Cell
    {
        return $this->cell;
    }

    /**
     * Rendering header element
     *
     * @return string
     */
    public function render()
    {


        $render = $this->options[$this->index]['title'];
		
        if(isset($this->options[$this->index]['visible'])):

            if(!$this->options[$this->index]['visible']):

                return '';

            endif;

        endif;
		
        foreach ($this->decorators as $decorator) {

            $render = $decorator->render(translate($render));

        }

        return $render;
    }
	
	public function getOption($name){
		
		return $this->options[$name];
		
	}

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        return $this->{$name};
    }
}
















