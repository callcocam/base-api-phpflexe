<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 06/11/2018
 * Time: 08:41
 */

if(!function_exists('translate')):

    function translate($provider,$replace=[]){

        $DS = DIRECTORY_SEPARATOR;

        $paths =  str_replace("::",$DS, sprintf("%s::config::language::%s.php",APP_DIR, env('LANGUAGE','pt_BR')));

        $lines = include $paths;

        if(isset($lines[$provider])):

            $line = $lines[$provider];

            if($replace):

                foreach ($replace as $key => $value) {

                    $line = str_replace(
                        [':'.$key, ':'.strtolower($key), ':'.strtoupper($key), ':'.ucfirst($key)],
                        [$value, strtolower($value), strtoupper($value), ucfirst($value)],
                        $line
                    );
                }
            endif;

            return $line;

        endif;

        return $provider;
    }

endif;