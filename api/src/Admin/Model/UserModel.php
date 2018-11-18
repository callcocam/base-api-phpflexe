<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 02:23
 */

namespace App\Admin\Model;


use Flexe\Model\Db;

class UserModel extends Db
{

    protected $table = "users";

    protected $fillable = ['company_id','role_id','name','email','cover','password','description','status','created_at_at','updated_at'];

    protected $hidden = ['password'];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];
}