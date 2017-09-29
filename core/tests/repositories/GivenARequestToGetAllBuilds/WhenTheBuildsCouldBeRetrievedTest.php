<?php

use Partham\core\interfaces\IDatabaseService;
use Partham\core\builds\BuildRepository;

class DatabaseServiceStubForBuildsRepository implements IDatabaseService
{
    public function getAll($table, $reverse = false, $limit = 1000)
    {
        return [
            [
                'reference' => 'SOME_REFERENCE',
                'start_time' => '2017-09-11 19:46',
                'end_time' => '2017-09-11 19:50',
                'app_id' => 1,
                'user_id' => 1,
                'state' => 'passed'
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

class WhenTheBuildsCouldBeRetrievedTest extends PHPUnit\Framework\TestCase
{
    private $result;

    public function setUp()
    {
        $subject = new BuildRepository(new DatabaseServiceStubForDeploysRepository());
        $this->result = $subject->getAll();
    }

    public function testOneResultIsReturned()
    {
        $this->assertEquals(sizeof($this->result), 1);
    }

    public function testReferenceIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->reference, "SOME_REFERENCE");
    }

    public function testStartTimeIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->startTime, "2017-09-11 19:46");
    }

    public function testEndTimeIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->endTime, "2017-09-11 19:50");
    }

    public function testAppIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->app, 1);
    }

    public function testUserIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->user, 1);
    }

    public function testStateIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->state, "passed");
    }
}