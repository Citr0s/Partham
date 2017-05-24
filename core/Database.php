<?php namespace Partham\Core;

require __DIR__ . '/../credentials.php';

class Database
{
    public $connection;

    function __construct()
    {
        $this->connection = new \mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    }

    public function getAll($table)
    {
        return $this->connection->query("SELECT * FROM {$table}");
    }

    public function get($columns, $table, $conditions, $limit = 1)
    {
        $columns = implode(', ', $columns);
        $conditions = implode(' = ', $conditions);

        return $this->connection->query("SELECT {$columns} FROM {$table} WHERE {$conditions} LIMIT {$limit}");
    }

    public function insert($table, $columns, $values)
    {
        $columns = implode(', ', $columns);
        $values = implode('\', \'', $values);

        return $this->connection->query("INSERT INTO {$table} ({$columns}) VALUES('{$values}')");
    }
}