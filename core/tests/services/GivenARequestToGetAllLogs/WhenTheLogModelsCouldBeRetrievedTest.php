<?php

use Partham\core\logs\ILogRepository;
use Partham\core\logs\LogService;
use Partham\core\logs\LogRecord;

class LogRepositoryStub implements ILogRepository
{

    public function getAll(): array
    {
        $record = new LogRecord();
        $record->app = "Partham";
        $record->severity = "Error";
        $record->message = "Something went wrong!";
        $record->exception = "PHP Fatal Exception: Something went wrong!";
        $record->loggedAt = "2017-09-11 20:56";

        return [$record];
    }

    public function save($severity, $logDetails)
    {
        // TODO: Implement save() method.
    }
}

class WhenTheLogModelsCouldBeRetrievedTest extends PHPUnit\Framework\TestCase
{
    private $result;

    public function setUp()
    {
        $subject = new LogService(new LogRepositoryStub());
        $this->result = $subject->getAll();
    }

    public function testOneResultIsReturned()
    {
        $this->assertEquals(sizeof($this->result), 1);
    }

    public function testAppNameIsMappedCorrectly()
    {
        $this->assertEquals($this->result[0]->appName, "Partham");
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
        $this->assertEquals($this->result[0]->loggedAt, "2017-09-11 20:56");
    }
}