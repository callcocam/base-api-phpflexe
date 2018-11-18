<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 04/09/2018
 * Time: 18:14
 */

namespace Flexe\Table;


use Flexe\Table\Decorator\DecoratorFactory;

class Cell extends AbstractElement
{
    /**
     * @var Header
     */
    protected $header;

    /**
     * Cell constructor.
     * @param Header $header
     */
    public function __construct(Header $header)
    {

        $this->header = $header;

    }

    /**
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * @param Header $header
     * @return Cell
     */
    public function setHeader(Header $header): Cell
    {
        $this->header = $header;
        return $this;
    }

    public function addDecorator($name, $options = []){

        $decorator = DecoratorFactory::factoryCell($name, $options);

        $decorator->setCell($this);

        $this->attachDecorators($decorator);

        return $decorator;
    }


    public function getActualRow(){

        return $this->table->getRow()->getActualRow();

    }

    public function render(){

        $value = '';

        $index = $this->getHeader()->index;

        $row = $this->getActualRow();

        if(is_array($row)):

            if(isset($row[$index])):

                $value = $row[$index];

            endif;


        endif;


        foreach ($this->decorators as $decorator):

            if($decorator->validConditions()):

                $value = $decorator->render($value);

            endif;

        endforeach;


        return $value;

    }
}














