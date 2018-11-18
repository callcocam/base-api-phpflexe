<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 04/09/2018
 * Time: 21:28
 */

namespace Flexe\Table\Decorator\Cell\Plugin;


use Flexe\Table\Decorator\Cell\AbstractCellDecorator;

class EditDecorator extends AbstractCellDecorator
{

    protected $attr = [];

    protected $vars;

    protected $route;

    /**
     * LinkCell constructor.
     * @param $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;

        if(!isset($this->options['route'])):

            throw new \InvalidArgumentException('route key in options argument required');

        endif;

        $this->route = $this->options['route'];

    }


    public function render($context)
    {

        $actualRow = $this->getActualRow();

        $params=[];
        $queryParams=[];
        $queryString='';


        if(isset($this->options['queryParams'])):

            foreach ($this->options['queryParams'] as $key => $option):

                $queryParams[$key] = $actualRow[$option];

            endforeach;
            $queryString = sprintf("?%s",implode("&",$queryParams));
        endif;

        $params['id'] = $context;

        if(isset($this->options['id'])):

            $params['id'] = $actualRow[$this->options['id']];

        endif;

        $this->getCell()->clearVar();

        return sprintf($this->route,$params['id'],$queryString);
    }
}