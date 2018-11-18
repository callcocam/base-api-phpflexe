<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Table;

use Flexe\Table\AbstractTable;

/**
 * Class ContactModel
 * @package App\Admin\Table
 * @Table
 */
class ContactTable extends AbstractTable
{

    protected $defaultOptions = [];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '10'],
        'name' => ['name' => 'name','title' => 'name', 'width' => '30'],
        'icone' => ['name' => 'icone','title' => 'icone', 'width' => '30'],
        'value' => ['name' => 'value','title' => 'value', 'width' => '30'],
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