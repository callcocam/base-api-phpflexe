<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras\Model;

use Flexe\Model\Db;

/**
 * Class ProjectModel
 * @package App\Obras\Model
 * @Model
 */


class ProjectModel extends Db
{

    protected $table = "projects";

    protected $fillable = ['id','company_id','user_id','name','alias','cover','description','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}