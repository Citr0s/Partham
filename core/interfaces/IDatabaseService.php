<?php namespace Partham\core\interfaces;

interface IDatabaseService
{
    public function getAll($table, $reverse = false, $limit = 1000);

    public function get($columns, $table, $conditions, $limit = 1);

    public function insert($table, $columns, $values);

    public function update($table, $conditions, $values);
}