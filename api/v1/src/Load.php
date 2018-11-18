<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 28/10/2018
 * Time: 23:53
 */

namespace Flexe;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Load extends Filesystem
{

    protected $dependencies = [];

    protected $paths = [
        'Form',
        'Route',
        'Model',
        'Table',
        'Middleware',
        'Services'
    ];

    protected $base_dir;
    /**
     * @var array
     */
    protected $modules;

    public function __construct(array $modules =['Admin','Home'])
    {
        $this->modules = $modules;
    }

    public function read($paths){

        $this->dependencies = [];

        if ($this->modules):

            foreach ($this->modules as $module):

                        $this->base_dir = $this->getBaseDir($module, $paths);

                        $this->dependencies = Collection::make($this->base_dir)->flatMap(function ($path) {
                            return $this->glob(sprintf("%s*.php",$path));
                        })->filter()->sortBy(function ($file) {
                            return $this->getClassName($file);
                        })->values()->keyBy(function ($file) {
                            return $this->resolveClass($file);
                        })->merge($this->dependencies)->all();


            endforeach;

        endif;
        if($this->dependencies):

            foreach ($this->dependencies as $key => $dependency):

                unset($this->dependencies[$key]);

                $this->dependencies[sprintf("\\App\\%s",$key)] = $this->name($dependency);

            endforeach;

        endif;

        return $this->dependencies;

    }


    /**
     * Get the name of the migration.
     *
     * @param  string  $path
     * @return string
     */
    public function getClassName($path)
    {
        return str_replace('.php', '', basename($path));
    }
    /**
     * Resolve a migration instance from a file.
     *
     * @param  string  $file
     * @return object
     */
    public function resolveClass($file)
    {

        $file =  str_replace('.php', '', $file);


        $ds = DIRECTORY_SEPARATOR;

        $class = Str::studly(implode("\\", array_slice(explode($ds, $file), env('LOAD_NIVEL_PATH',7))));

        return  $class;
    }



    public function getConfig(){

        $DS = DIRECTORY_SEPARATOR;

        $paths =  str_replace("::",$DS, sprintf("%s::config::settings::",APP_DIR));

        $files = Collection::make($paths)->flatMap(function ($path) {
            return $this->glob(sprintf("%s*.php",$path));
        })->filter()->sortBy(function ($file) {
            return $this->getClassName($file);
        })->values()->keyBy(function ($file) {
            return $this->resolveClass($file);
        })->all();

        $includes = [];
        if($files):

            foreach ($files as $file) {

                $includes = array_merge($includes,$this->getRequire($file));

            }

        endif;

        return $includes;

    }


    private function getBaseDir($module, $type){

        $source = env('SOURCE_DIR','src');

        $DS = DIRECTORY_SEPARATOR;

        return str_replace("::",$DS, sprintf("%s::%s::%s::%s::",APP_DIR, $source, $module , $type));
    }




}