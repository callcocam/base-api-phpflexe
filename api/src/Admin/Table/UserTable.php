<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 09:01
 */

namespace App\Admin\Table;


use Flexe\Table\AbstractTable;

class UserTable extends AbstractTable
{

    protected $defaultOptions = [
        'title'=>'Lista De Usuários',
        'showActions'=>[
            'label'=>'Adcionar Novo',
            'route'=>'admin.user.create',
        ],
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '70'],
        'name' => ['name' => 'name','title' => 'Nome','alias'=>'users'],
        'description' => ['name' => 'description','title' => 'Descrição','alias'=>'users'],
        'status' => ['name' => 'status','title' => 'Status', 'width' => '50','format'=>'status'],
        'created_at' => ['name' => 'created_at','title' => 'Cadastrado Em', 'width' => '150','format'=>'date'],
        'updated_at' => ['name' => 'updated_at','title' => 'Atualizado Em', 'width' => '150','format'=>'date'],
        'editar' => ['name' => 'editar','title' => 'Editar', 'width' => '30','format'=>'btn','classe'=>'btn btn-success btn-sm', 'icone'=>'fa fa-edit','order'=>false,'alias'=>false],
        'excluir' => ['name' => 'excluir','title' => 'Excluir', 'width' => '30','format'=>'btn','classe'=>'btn btn-danger btn-sm', 'icone'=>'fa fa-trash','order'=>false,'alias'=>false],
    ];

    public function init()
    {
        $this->getHeader('editar')->getCell()->addDecorator('edit',[
            'route'=>'/admin/usuarios/%s/editar%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
        $this->getHeader('excluir')->getCell()->addDecorator('btn',[
            'route'=>'/admin/usuarios/%s/excluir%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
    }

    public function initFilter( $query )
    {
        // TODO: Implement initFilter() method.
    }
}