<?php

class Conexao
{
    
    public static $instance;
 
    public static function getInstance()
    {

        $host = 'mysql:host=127.0.0.1;port="3306";dbname=revvo';
        $user = 'root';
        $pass = '';

        if (!isset(self::$instance)) {
            self::$instance = new PDO($host, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
}