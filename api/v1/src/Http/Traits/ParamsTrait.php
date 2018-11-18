<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 10:25
 */

namespace Flexe\Http\Traits;


use Slim\Http\Request;

trait ParamsTrait
{

    /**
     * @var $rq Request
     */
    protected $rq;

    protected $company;

    public function get($key = null){

        if($key):

            return $this->rq->getQueryParam($key);

        endif;

        return $this->rq->getQueryParams();
    }

    public function post($key = null){

        $data = $this->rq->getParsedBody();
        if($key):

            return $data[$data];

        endif;

        return $data;
    }

    public function image(){

        /**
         * @var UploadedFile $Image
         */

        $Image = null;

        $Files = $this->rq->getUploadedFiles();

        if(isset($Files['image'])):

            if($Files['image']):

                $Image = $Files['image'];

                if(!empty($Image->getClientFilename())):

                    $Name = explode(".", $Image->getClientFilename());

                    $Folder = $this->getPath("dist/uploads",sprintf("%s.%s", str_slug(reset($Name)), end($Name)));
					
                    $Image->moveTo(sprintf("%s/%s", APP_UPLOAD_DIR, $Folder));

                    if(!$Image->getError()):

                         $data['cover'] =$Folder;
						 
                        return $data;

                    endif;

                endif;

            endif;

        endif;

        return [];
    }

     protected function getPath($Folder, $FileName){

        $SubFolder = explode("/", $Folder);

        $NewFolder = '';

        if(count($SubFolder) > 1):

            foreach ($SubFolder as $sub):

                $NewFolder = $this->createPath($sub, $NewFolder);

            endforeach;

        endif;

        list($y, $m) = explode("/", date("Y/m"));

        $NewFolder = $this->createPath($y, $NewFolder);

        $NewFolder = $this->createPath($m, $NewFolder);

        return sprintf("%s/%s", $NewFolder, $FileName);
    }

    protected function createPath($Path, $NewFolder){

        $Dir = sprintf("%s%s/%s", APP_UPLOAD_DIR, $NewFolder, $Path);

        if(!is_dir($Dir)):

            mkdir($Dir);

        endif;

        return sprintf("%s/%s", $NewFolder, $Path);
    }

}