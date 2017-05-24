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

        $this->database->insert('deploys', ['log', 'request', 'status', 'startTime'], ['nothing yet...', $request, 'before', date("Y-m-d H:i:s")]);

        $output = shell_exec("cd /var/www/{$appName} && sudo bash deploy.sh 2>&1");

        $this->database->insert('deploys', ['log', 'request', 'status', 'startTime'], [$output, $request, 'maybe', date("Y-m-d H:i:s")]);

        if (is_null($output))
            return;

        if (strpos($request, 'payload=') >= 0)
            $request = str_replace('payload=', '', urldecode($request));

        $this->database->insert('deploys', ['log', 'request', 'status', 'startTime'], [$output, $request, 'success', date("Y-m-d H:i:s")]);
    }
}