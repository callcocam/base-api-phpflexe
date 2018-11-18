<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class CompanieModel
 * @package App\Admin\Model
 * @Model
 */


class CompanieModel extends Db
{

    protected $table = "companys";

    protected $fillable = ['id','company_id','type','cover','assets','name','alias','description','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}