<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Model;

use Flexe\Model\Db;

/**
 * Class ConclusoeModel
 * @package App\Obras\Model
 * @Model
 */


class ConclusoeModel extends Db
{

    protected $table = "conclusoes";

    protected $fillable = ['id','company_id','project_id','description','status','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];
}