<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class AddresModel
 * @package App\Admin\Model
 * @Model
 */


class AddresModel extends Db
{

    protected $table = "address";

    protected $fillable = ['id','company_id','parent','assets','name','alias','street','district','number','complements','zip','city','state','country','longetude','latitude','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}