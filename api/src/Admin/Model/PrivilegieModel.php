<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class PrivilegieModel
 * @package App\Admin\Model
 * @Model
 */


class PrivilegieModel extends Db
{

    protected $table = "permissions";

    protected $fillable = ['id','company_id','role_id','resource_id','name','alias','description','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}