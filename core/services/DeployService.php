<?php namespace Partham\core\services;

use Partham\core\helpers\GuidHelper;

class DeployService
{
    private $allowedApps = ['chat', 'ci'];

    function __construct()
    {
        $this->database = new DatabaseService();
    }

    public function invoke($appName, $request)
    {
        if (!in_array($appName, $this->allowedApps))
            return;

        $identifier = GuidHelper::newGuid();

        if (strpos($request, 'payload=') >= 0)
            $request = str_replace('payload=', '', urldecode($request));

        $this->database->insert('deploys', ['log', 'request', 'status', 'startTime', 'identifier'], ['deploy started...', $request, 'started', date("Y-m-d H:i:s"), $identifier]);

        $output = shell_exec("cd /var/www/{$appName} && sudo bash deploy.sh 2>&1");

        if (is_null($output))
            return;

        $this->database->update('deploys', ['identifier' => $identifier], ['log' => $output, 'request' => $request, 'status' => 'success', 'endTime' => date("Y-m-d H:i:s")]);
    }
}