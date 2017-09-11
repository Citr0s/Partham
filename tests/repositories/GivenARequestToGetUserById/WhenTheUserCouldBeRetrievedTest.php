<?php

use Partham\core\interfaces\IDatabaseService;
use Partham\core\repositories\UserRepository;

class DatabaseServiceStubForUserRepository implements IDatabaseService
{
    public function getAll($table, $reverse = false, $limit = 1000)
    {
        // TODO: Implement getAll() method.
    }

    public function get($columns, $table, $conditions, $limit = 1)
    {
        return [
            'id' => 1,
            'name' => 'John Cena'
        ];
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

class WhenTheUserCouldBeRetrievedTest extends PHPUnit\Framework\TestCase
{
    private $result;

    public function setUp()
    {
        $subject = new UserRepository(new DatabaseServiceStubForUserRepository());
        $this->result = $subject->getById(1);
    }

    public function testOneResultIsReturned()
    {
        $this->assertEquals(sizeof($this->result), 1);
    }

    public function testNameIsMappedCorrectly()
    {
        $this->assertEquals($this->result, "John Cena");
    }
}