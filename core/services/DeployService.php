<?php namespace Partham\core\services;

use Partham\core\helpers\GuidHelper;
use Partham\core\mappers\DeployModelMapper;
use Partham\core\repositories\AppRepository;
use Partham\core\repositories\DeployRepository;

class DeployService
{
    private $allowedApps = ['chat', 'ci', 'game'];
    private $database;
    private $deployRepository;
    private $appRepository;

    function __construct()
    {
        $this->database = new DatabaseService();
        $this->deployRepository = new DeployRepository($this->database);
        $this->appRepository = new AppRepository($this->database);
    }

    public function invoke($appName, $request)
    {
        if (!in_array($appName, $this->allowedApps))
            return;

        if (strpos($request, 'payload=') >= 0)
            $request = str_replace('payload=', '', urldecode($request));

        $decodedRequest = json_decode($request, true);

        if ($decodedRequest['state'] === 'started') {
            $this->handleBuildStart($decodedRequest);
            return;
        }

        $this->handleBuildEnd($decodedRequest);

        $identifier = GuidHelper::newGuid();

        $this->handleDeployStart($identifier);

        $output = shell_exec("cd /var/www/{$appName} && sudo bash deploy.sh 2>&1");

        if (is_null($output)) {
            $this->handleDeployEnd($identifier, 'failed');
            return;
        }

        $this->handleDeployEnd($identifier, 'passed');
    }

    public function getAll()
    {
        $response = [];

        $deploys = $this->deployRepository->getAll();
        $mapper = new DeployModelMapper($this->appRepository);

        foreach ($deploys as $deploy)
            $response[] = $mapper->map($deploy);

        return $response;
    }

    public function handleCommit($payload)
    {
        $payload = json_decode($payload, true);
        $reference = $payload['head_commit']['id'];

        $this->database->insert('builds', ['reference', 'app_id', 'user_id'], [$reference, 1, 1]);
    }

    public function handleBuildStart($payload)
    {
        $this->database->update('builds', ['reference' => $payload['commit']], ['start_time' => date("Y-m-d H:i:s"), 'state' => $payload['state']]);
    }

    public function handleBuildEnd($payload)
    {
        $this->database->update('builds', ['reference' => $payload['commit']], ['end_time' => date("Y-m-d H:i:s"), 'state' => $payload['state']]);
    }

    public function handleDeployStart($identifier)
    {
        $this->database->insert('deploys', ['reference', 'app_id', 'user_id', 'start_time', 'state'], [$identifier, 1, 1, date("Y-m-d H:i:s"), 'deploying']);
    }

    public function handleDeployEnd($identifier, $state)
    {
        $this->database->update('deploys', ['reference' => $identifier], ['end_time' => date("Y-m-d H:i:s"), 'state' => $state]);
    }
}