<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 04/09/2018
 * Time: 17:57
 */

namespace Flexe\Table;


class Row extends AbstractElement
{

    protected $actualRow;

    /**
     * Row constructor.
     * @param AbstractTable $table
     */
    public function __construct(AbstractTable $table)
    {
        $this->table = $table;

    }

    /**
     * @return mixed
     */
    public function getActualRow()
    {
        return $this->actualRow;
    }

    /**
     * @param mixed $actualRow
     * @return Row
     */
    public function setActualRow($actualRow)
    {
        $this->actualRow = $actualRow;
        return $this;
    }


    public function renderRow(){


        return $this->renderArray();

    }


    private function renderArray($type = 'assc')
    {
        $data =$this->table->getData();

        $headers = $this->table->getHeaders();


        $render = [];

        foreach ($data as $rowData) {

            $this->setActualRow($rowData->toArray());

            $temp = array();

            foreach ($headers as $name => $options) {


                if ($type == 'assc') {

                    $temp[$name] =  $this->table->getHeader($name)->getCell()->render('array');

                } else {

                    $temp[] =  $this->table->getHeader($name)->getCell()->render('array');

                }
            }

            $render[] = $temp;

        }

        return $render;
    }
}





















