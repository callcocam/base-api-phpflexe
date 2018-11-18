<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class ContactModel
 * @package App\Admin\Model
 * @Model
 */


class ContactModel extends Db
{

    protected $table = "contacts";

    protected $fillable = ['id','company_id','parent','assets','name','icone','contact','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}