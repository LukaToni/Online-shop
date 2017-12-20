<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DBInit {

    private static $host = "localhost";
    private static $user = "root";
    private static $password = "ep";
    private static $schema = "spletna";
    private static $instance = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * Vrne instanco razreda PDO, ki vsebuje povezavo na bazo.
     * 
     * @return PDO Instanca razreda PDO 
     */
    public static function getInstance() {
        if (!self::$instance) {
            $config = "mysql:host=" . self::$host
                    . ";dbname=" . self::$schema;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            self::$instance = new PDO($config, self::$user, self::$password, $options);
        }

        return self::$instance;
    }

}

?>