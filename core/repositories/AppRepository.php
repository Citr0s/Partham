<?php namespace Partham\core\repositories;

use Partham\core\deploys\DeployService;
use Partham\core\interfaces\IDatabaseService;

class AppRepository
{
    private $database;

    public function __construct(IDatabaseService $database)
    {
        $this->database = $database;
    }

    public function getById($appId)
    {
        $record = $this->database->get(['name'], 'apps', ['id', $appId]);
        return $record['name'];
    }

    public function getIdByName($appName)
    {
        switch ($appName) {
            case 'game':
                $translatedName = 'TypeScript Game';
                break;
            case 'ci':
                $translatedName = 'Partham';
                break;
            case 'chat':
                $translatedName = 'Awesome Chat';
                break;
            default:
                $translatedName = 'Partham';
                break;
        }

        $record = $this->database->get(['id'], 'apps', ['name', $translatedName]);
        return $record['id'];
    }
}