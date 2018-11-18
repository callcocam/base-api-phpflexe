<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Table;

use Flexe\Table\AbstractTable;

/**
 * Class LicitacoeModel
 * @package App\Obras\Table
 * @Table
 */
class LicitacoeTable extends AbstractTable
{

    protected $defaultOptions = [];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '10'],
        'status' => ['name' => 'status','title' => 'Status', 'width' => '30','format'=>'status'],
        'created_at' => ['name' => 'created_at','title' => 'Cadastrado Em', 'width' => '50','format'=>'date'],
        'updated_at' => ['name' => 'updated_at','title' => 'Atualizado Em', 'width' => '50','format'=>'date'],
		'editar' => ['name' => 'editar','title' => 'Editar', 'width' => '30','format'=>'btn','classe'=>'btn btn-success btn-sm', 'icone'=>'fa fa-edit','order'=>false,'alias'=>false],
        'excluir' => ['name' => 'excluir','title' => 'Excluir', 'width' => '30','format'=>'btn','classe'=>'btn btn-danger btn-sm', 'icone'=>'fa fa-trash','order'=>false,'alias'=>false],
    ];

    public function init()
    {
        $this->getHeader('created_at')->getCell()->addDecorator('date', [
            'time'=>true
        ]);

        $this->getHeader('updated_at')->getCell()->addDecorator('date', [
            'time'=>true
        ]);
        
		 $this->getHeader('editar')->getCell()->addDecorator('edit',[
            'route'=>'/obras/licitacoe/%s/editar%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
        $this->getHeader('excluir')->getCell()->addDecorator('btn',[
            'route'=>'/obras/licitacoe/%s/excluir%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);

    }

    public function initFilter( $query )
    {

    }
}