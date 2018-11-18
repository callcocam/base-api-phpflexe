<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Model;

use Flexe\Model\Db;

/**
 * Class ExecucoeModel
 * @package App\Obras\Model
 * @Model
 */


class ExecucoeModel extends Db
{

    protected $table = "execucoes";

    protected $fillable = ['id','company_id','project_id','percentual','data_medicao','previsao_conclusao','description','status','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'data_medicao'=>'timestamp','previsao_conclusao'=>'timestamp',
        'created_at'=>'timestamp','updated_at'=>'timestamp',
    ];

}