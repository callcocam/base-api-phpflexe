<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Model;

use Flexe\Model\Db;

/**
 * Class LicitacoeModel
 * @package App\Obras\Model
 * @Model
 */


class LicitacoeModel extends Db
{

    protected $table = "licitacoes";

    protected $fillable = ['id','company_id','project_id','number_processo','modalidade','company','document','description','status','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];
}