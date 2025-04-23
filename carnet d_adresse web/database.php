<?php
class Database
{
    private static $dbName = 'crud_tutorial';
    private static $dbHost = 'localhost';
    private static $dbPort = '3306';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    private static $cont  = null;

    public function __construct()
    {
        // Constructeur vide pour éviter l'initialisation directe
    }

    public static function connect()
    {
        if (null == self::$cont) {
            try {
                self::$cont = new PDO(
                    "mysql:host=" . self::$dbHost . ";port=" . self::$dbPort . ";dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbUserPassword,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Connection error: " . $e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
