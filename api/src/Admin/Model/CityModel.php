<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class CityModel
 * @package App\Admin\Model
 * @Model
 */


class CityModel extends Db
{

    protected $table = "citys";

    protected $fillable = ['id','company_id','name','cover','uf','cuf','ibge','zip','cpais','xpais','description','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}