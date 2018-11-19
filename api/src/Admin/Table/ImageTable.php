<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Table;

use Flexe\Table\AbstractTable;

/**
 * Class ImageModel
 * @package App\Admin\Table
 * @Table
 */
class ImageTable extends AbstractTable
{

    protected $defaultOptions = [];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '10'],
        'name' => ['name' => 'name','title' => 'Nome'],
        'link' => ['name' => 'link','title' => 'link', 'width' => '120'],
        'type' => ['name' => 'type','title' => 'type', 'width' => '20'],
        'width' => ['name' => 'width','title' => 'width', 'width' => '20'],
        'folder' => ['name' => 'folder','title' => 'folder', 'width' => '50'],
        'description' => ['name' => 'description','title' => 'Detalhes', 'width' => '120'],
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
            'route'=>'/admin/image/%s/editar%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
        $this->getHeader('excluir')->getCell()->addDecorator('btn',[
            'route'=>'/admin/image/%s/excluir%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);

    }

    public function initFilter( $query )
    {

    }
}