<?php

use Partham\core\interfaces\IDatabaseService;
use Partham\core\logs\LogRepository;

class DatabaseServiceStubForLogsRepository implements IDatabaseService
{
    public function getAll($table, $reverse = false, $limit = 1000)
    {
        return [
            [
                'app' => 'Partham',
                'severity' => 'Error',
                'message' => 'Something went wrong!',
                'exception' => 'PHP Fatal Exception: Something went wrong!',
                'logged_at' => '2017-09-11 19:46'
            ]
        ];
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

class WhenTheLogsCouldBeRetrievedTest extends PHPUnit\Framework\TestCase
{
    private $result;

    public function setUp()
    {
        $subject = new LogRepository(new DatabaseServiceStubForLogsRepository());
        $this->result = $subject->getAll();
    }

    public function testOneResultIsReturned()
    {
        $this->assertEquals(sizeof($this->result), 1);
    }

    public function testAppNameIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->app, "Partham");
    }

    public function testSeverityIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->severity, "Error");
    }

    public function testMessageIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->message, "Something went wrong!");
    }

    public function testExceptionIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->exception, "PHP Fatal Exception: Something went wrong!");
    }

    public function testLoggedAtIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->loggedAt, "2017-09-11 19:46");
    }
}