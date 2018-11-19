<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Admin\Model;

use Flexe\Model\Db;

/**
 * Class GalleryModel
 * @package App\Admin\Model
 * @Model
 */


class GalleryModel extends Db
{

    protected $table = "gallerys";

    protected $fillable = ['id','company_id','parent','assets','name','folder','status','created_at','updated_at'];

    protected $hidden = [];
    
     protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

}