<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 14:54
 */

namespace App\Admin;


class Module
{
    const NAME = 'Admin';

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