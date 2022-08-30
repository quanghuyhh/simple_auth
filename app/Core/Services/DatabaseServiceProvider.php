<?php

namespace App\Core\Services;

use App\Common\SimpleOrm;
use PDO;
use mysqli;

class DatabaseServiceProvider
{
    public static $connection = null;

    public static string $host;
    public static string $username;
    public static string $password;
    public static string $database;

    public function __construct(
        string $host = '',
        string $database = '',
        string $username = '',
        string $password = ''

    ) {
        static::$host = $host;
        static::$username = $username;
        static::$password = $password;
        static::$database = $database;
        $this->setConnection();
    }

    public function setConnection()
    {
        static::$connection = new mysqli(static::$host, static::$username, static::$password);

        if (static::$connection->connect_error) {
            die(sprintf('Unable to connect to the database. %s', static::$connection->connect_error));
        }

        SimpleOrm::useConnection(static::$connection, static::$database);
    }

    public static function createConnection($host, $username, $password, $database, array $options = [], $port = 3306, $charset = null) {
        $dsn = "mysql:dbname={$database};host={$host};port={$port}";
        static::$connection = new PDO($dsn, $username, $password, $options);
    }

    /**
     * Get our connection instance.
     *
     * @access public
     * @static
     * @return PDO
     */
    public static function getConnection() {
        return static::$conn;
    }
}