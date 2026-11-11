
<?php

class Database
{
    private static ?PDO $connection = null;

    /**
     * Retourne l'instance PDO unique.
     */
    public static function p(): PDO
    {
        if (self::$connection === null) {
            $config = require dirname(__DIR__, 2) . '/config/config.php';

            self::$connection = self::connect($config['database']);
        }

        return self::$connection;
    }

    /**
     * Initialise la connexion MySQL.
     */
    public static function connect(array $config): PDO
    {
        $host     = $config['host'] ?? '127.0.0.1';
        $port     = $config['port'] ?? '3306';
        $dbname   = $config['name'] ?? 'fasobusiness';
        $username = $config['user'] ?? 'root';
        $password = $config['password'] ?? '';
        $charset  = $config['charset'] ?? 'utf8mb4';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

        return new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
}
