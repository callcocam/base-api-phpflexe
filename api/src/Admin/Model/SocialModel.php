<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class SocialModel
 * @package App\Admin\Model
 * @Model
 */


class SocialModel extends Db
{

    protected $table = "socials";

    protected $fillable = ['id','company_id','parent','assets','name','icone','value','status','created_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];
}