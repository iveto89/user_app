<?php
namespace App;
use \PDO;
use \PDOException;

class Db {
    private $connection;
    private static $instance;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'user_app';

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host; dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}