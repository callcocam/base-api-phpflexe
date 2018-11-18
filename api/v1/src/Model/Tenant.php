<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 05/11/2018
 * Time: 13:33
 */

namespace Flexe\Model;


class Tenant extends Db
{

    protected $table = "companys";

    protected $fillable = ['id','company_id','tipo','cover','assets','name','alias','description','status','created_at','updated_at'];

    protected $hidden = [];

    protected $company=null;


    public function getCompany(){
        $this->company = $this->where([
            'assets' =>COMPANY_KEY
        ])->first();

        if(!$this->company):

            $data['assets']         = COMPANY_KEY;

            $data['company_id']     = 1;

            $data['type']           = 1;

            $data['name']           = COMPANY_KEY;

            $data['alias']          = str_slug(COMPANY_KEY);

            $data['email']          = sprintf('admin@%s.com', COMPANY_KEY);

            $data['status']         = 1;

            $data['updated_at']     = date("Y-m-d H:i:s");


            self::query()->insert($data);

            $this->company = $this->where([

                'assets' =>COMPANY_KEY

            ])->first();

            if($this->company):

                $this->company->company_id = $this->company->id;

                $this->company->save();

            endif;
        endif;

        if(!defined('COMPANYS_ID')){

            define('COMPANYS_ID', $this->company->id);

        }
        return $this->company->toArray();

    }

}