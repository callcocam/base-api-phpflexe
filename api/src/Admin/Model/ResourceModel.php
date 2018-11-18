<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class ResourceModel
 * @package App\Admin\Model
 * @Model
 */


class ResourceModel extends Db
{

    protected $table = "resources";

    protected $fillable = ['id','company_id','name','alias','route','description','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}