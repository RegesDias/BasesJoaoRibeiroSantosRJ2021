<?php
class Conexao{
    public static $instance;

    public static function Inst() {

        if (!isset(self::$instance)) {
            self::$instance = new PDO($dsn, $usr, $pwd ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
        return self::$instance;
    }
    public static function getInst() {
        return self::$instance;
    }
    
}
?>