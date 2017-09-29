<?php namespace Partham\core\logs;

interface ILogRepository
{
    public function getAll(): array;

    public function save($severity, $logDetails);
}