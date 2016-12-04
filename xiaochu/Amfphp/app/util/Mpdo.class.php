<?php
/**
 * MySql Util
 */
class Mpdo {
	
	private static $_dbh = null; //静态属性,所有数据库实例共用,避免重复连接数据库
	
    public function __construct() {
        class_exists('PDO') or die("PDO: class not exists.");
        //连接数据库
        if ( is_null(self::$_dbh) ) {
            self::$_dbh = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB,
                        MYSQL_USER,
                        MYSQL_PASS,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
        }
    }
    /**
     * get connection
     * @return PDO
     */
    public static function getConnection() {
    	
    	if(is_null(self::$_dbh)){
    		new self();
    	}
        return self::$_dbh;
    }

    public static function close(){
        self::$_dbh = null;
    }

}