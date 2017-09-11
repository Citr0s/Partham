<?php namespace Partham\core\interfaces;

interface ILogRepository
{
    public function getAll(): array;

    public function save($severity, $logDetails);
}