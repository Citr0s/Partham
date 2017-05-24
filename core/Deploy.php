<?php namespace Partham\core;

class Deploy
{
    private $allowedApps = ['chat', 'ci'];

    function __construct()
    {
        $this->database = new Database();
    }

    public function invoke($appName, $request)
    {
        if (!in_array($appName, $this->allowedApps))
            return;

        $identifier = Helpers::GUID();

        $this->database->insert('deploys', ['log', 'request', 'status', 'startTime', 'identifier'], ['build started...', $request, 'started', date("Y-m-d H:i:s"), $identifier]);

        $output = shell_exec("cd /var/www/{$appName} && sudo bash deploy.sh 2>&1");

        if (is_null($output))
            return;

        if (strpos($request, 'payload=') >= 0)
            $request = str_replace('payload=', '', urldecode($request));

        $this->database->update('deploys', ['identifier' => $identifier], ['log', 'request', 'status', 'endTime'], [$output, $request, 'success', date("Y-m-d H:i:s")]);
    }
}