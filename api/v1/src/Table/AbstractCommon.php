<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 03/09/2018
 * Time: 09:16
 */

namespace Flexe\Table;



class AbstractCommon
{

    protected $table;

    protected $router;

    protected $options;


    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     * @return AbstractCommon
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     * @return AbstractTable
     */
    public function setOptions($options)
    {
        $this->options = new Options\Option($options);
        return $this;
    }


}