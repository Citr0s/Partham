<?php

use Partham\core\interfaces\IDatabaseService;
use Partham\core\logs\LogRepository;

class DatabaseServiceStubForSaveLogsRepository implements IDatabaseService
{
    public function getAll($table, $reverse = false, $limit = 1000)
    {
        // TODO: Implement getAll() method.
    }

    public function get($columns, $table, $conditions, $limit = 1)
    {
        // TODO: Implement get() method.
    }

    public function insert($table, $columns, $values)
    {
        // TODO: Implement insert() method.
    }

    public function update($table, $conditions, $values)
    {
        // TODO: Implement update() method.
    }
}

class WhenTheLogsCouldBeSavedTest extends PHPUnit\Framework\TestCase
{
    private $result;

    public function setUp()
    {
        $subject = new LogRepository(new DatabaseServiceStubForSaveLogsRepository());
        $this->result = $subject->save('', '{"app":"", "message":"", "exception":""}');
    }

    public function testLogIsSavedSuccessfully()
    {
        $this->assertEquals($this->result, true);
    }
}