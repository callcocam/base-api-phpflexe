<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Table;

use Flexe\Table\AbstractTable;

/**
 * Class CompanieModel
 * @package App\Admin\Table
 * @Table
 */
class CompanieTable extends AbstractTable
{

    protected $defaultOptions = [
            'title'=>'Dados Da Empresa'
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '70'],
        'name' => ['name' => 'name','title' => 'Nome'],
        'status' => ['name' => 'status','title' => 'Status', 'width' => '50','format'=>'status'],
        'created_at' => ['name' => 'created_at','title' => 'Cadastrado Em', 'width' => '150','format'=>'date'],
        'updated_at' => ['name' => 'updated_at','title' => 'Atualizado Em', 'width' => '150','format'=>'date'],
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
            'route'=>'/admin/empresa/%s/editar%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
        $this->getHeader('excluir')->getCell()->addDecorator('btn',[
            'route'=>'/admin/empresa/%s/excluir%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
    }

    public function initFilter( $query )
    {

    }
}