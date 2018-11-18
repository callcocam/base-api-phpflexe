<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Obras;

/**
 * Class Rpps
 * @package App\Rpps
 * @Module
 * @Route("/{{ROUTE-NAME}}")
 */
class Module
{

    const NAME = 'Obras';

    public static function getPathModule() {
        return __DIR__ . '/../' . self::NAME;
    }

    public static function getControllers() {
        return realpath(__DIR__ . '/Controller');
    }

    public static function getModels() {
        return realpath(__DIR__ . '/Model');
    }


    public static function getTables() {
        return realpath(__DIR__ . '/Table');
    }

    public static function getRoutes() {
        return realpath(__DIR__ . '/Route');
    }


    public static function getNameSpace() {
        return __NAMESPACE__;
    }



}