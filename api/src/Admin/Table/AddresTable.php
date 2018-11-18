<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Table;

use Flexe\Table\AbstractTable;

/**
 * Class AddresModel
 * @package App\Admin\Table
 * @Table
 */
class AddresTable extends AbstractTable
{

    protected $defaultOptions = [];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '10'],
        'name' => ['name' => 'name','title' => 'name', 'width' => '30'],
        'alias' => ['name' => 'alias','title' => 'alias', 'width' => '30'],
        'street' => ['name' => 'street','title' => 'street', 'width' => '30'],
        'district' => ['name' => 'district','title' => 'district', 'width' => '30'],
        'number' => ['name' => 'number','title' => 'number', 'width' => '30'],
        'complements' => ['name' => 'complements','title' => 'complements', 'width' => '30'],
        'zip' => ['name' => 'zip','title' => 'zip', 'width' => '30'],
        'city' => ['name' => 'city','title' => 'city', 'width' => '30'],
        'state' => ['name' => 'state','title' => 'state', 'width' => '30'],
        'country' => ['name' => 'country','title' => 'country', 'width' => '30'],
        'longetude' => ['name' => 'longetude','title' => 'longetude', 'width' => '30'],
        'latitude' => ['name' => 'latitude','title' => 'latitude', 'width' => '30'],
        'assets' => ['name' => 'assets','title' => 'assets', 'width' => '30'],
        'parent' => ['name' => 'parent','title' => 'parent', 'width' => '30'],
        'status' => ['name' => 'status','title' => 'Status', 'width' => '30','format'=>'status'],
        'created_at' => ['name' => 'created_at','title' => 'Cadastrado Em', 'width' => '50','format'=>'date'],
        'updated_at' => ['name' => 'updated_at','title' => 'Atualizado Em', 'width' => '50','format'=>'date']
    ];

    public function init()
    {
        $this->getHeader('created_at')->getCell()->addDecorator('date', [
            'time'=>true
        ]);

        $this->getHeader('updated_at')->getCell()->addDecorator('date', [
            'time'=>true
        ]);

    }

    public function initFilter( $query )
    {

        $query->where($this->getParams()->getParams());
        
    }
}