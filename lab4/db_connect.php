<?php


class Database {
    private static $instances = [];
    private SQLite3 $sqlite;

    protected function __construct() {
        $this->sqlite = new SQLite3(__DIR__ . '/database/db.sqlite');
        $this->sqlite->exec("CREATE TABLE IF NOT EXISTS expenses(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            amount INTEGER,
            date TEXT,
            paymentMethod TEXT)");
    }

    protected function __clone() { }

    public static function getInstance(): Database
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getSQLite(): SQLite3 {
        return $this->sqlite;
    }
}