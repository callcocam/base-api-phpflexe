<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class ImageModel
 * @package App\Admin\Model
 * @Model
 */


class ImageModel extends Db
{

    protected $table = "images";

    protected $fillable = ['id','company_id','parent','assets','name','description','link','type','width','folder','status','updated_at'];

    protected $hidden = [];
    
     protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}