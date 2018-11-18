<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Table;

use Flexe\Table\AbstractTable;

/**
 * Class CityModel
 * @package App\Admin\Table
 * @Table
 */
class CityTable extends AbstractTable
{

    protected $defaultOptions = [
        'title'=>'Lista De Cidades',
        'controller'=>'/city'
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['name' => 'id','title' => 'Código', 'width' => '20','alias'=>false],
        'name' => ['name' => 'name','title' => 'Nome'],
        'ibge' => ['name' => 'ibge','title' => 'Cód. Ibge', 'width' => '100'],
        'uf' => ['name' => 'uf','title' => 'Uf', 'width' => '50'],
        'xpais' => ['name' => 'xpais','title' => 'Pais', 'width' => '100'],
        'status' => ['name' => 'status','title' => 'Status', 'width' => '100','alias'=>false],
        'updated_at' => ['name' => 'updated_at','title' => 'Atualizado Em', 'width' => '150','format'=>'date','alias'=>false],
        'editar' => ['name' => 'editar','title' => 'Editar', 'width' => '30','format'=>'btn','classe'=>'btn btn-success btn-sm', 'icone'=>'fa fa-edit','order'=>false,'alias'=>false],
        'excluir' => ['name' => 'excluir','title' => 'Excluir', 'width' => '30','format'=>'btn','classe'=>'btn btn-danger btn-sm', 'icone'=>'fa fa-trash','order'=>false,'alias'=>false],
    ];

    public function init()
    {

        $this->getHeader('editar')->getCell()->addDecorator('edit',[
            'route'=>'/admin/cidades/%s/editar%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);
        $this->getHeader('excluir')->getCell()->addDecorator('btn',[
            'route'=>'/admin/cidades/%s/excluir%s',
            'id'=>'id',
            'query'=>$this->getParams()->getParams()
        ]);

    }

    public function initFilter( $query )
    {

    }
}