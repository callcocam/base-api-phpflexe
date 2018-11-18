<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class RoleModel
 * @package App\Admin\Model
 * @Model
 */


class RoleModel extends Db
{

    protected $table = "roles";

    protected $fillable = ['id','company_id','role_id','name','alias','is_admin','description','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];
}