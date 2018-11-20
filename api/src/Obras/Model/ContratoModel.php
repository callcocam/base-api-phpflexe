<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Model;

use Flexe\Model\Db;

/**
 * Class ContratoModel
 * @package App\Obras\Model
 * @Model
 */


class ContratoModel extends Db
{

    protected $table = "contratos";

    protected $fillable = ['id','company_id','project_id','convenio', 'convenio_siafi','vigencia','proposta','programa','contratacao','publicacao','investimento','repasse','contrapartida','description','status','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp','vigencia'=>'timestamp','contratacao'=>'timestamp'
    ];
}