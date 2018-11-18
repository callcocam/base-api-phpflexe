<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/08/2018
 * Time: 00:44
 */

namespace Flexe\Model;


trait ConnectTrait
{

    public function connect(){

        $pdo = new \PDO(sprintf("%s:dbname=%s;host=%s", env('DB_CONNECTION','mysql'), env('DB_DATABASE','slim'), env('DB_HOST','localhost')), env('DB_USERNAME','root'),  env('DB_PASSWORD',''));
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);
        $pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
        return $pdo;
    }

}