<?php namespace Partham\core;

class Deploy
{
    private $allowedApps = ['chat', 'ci'];

    function __construct()
    {
        $this->database = new Database();
    }

    public function invoke($appName)
    {
        if (!in_array($appName, $this->allowedApps))
            return;

        echo "<pre>Running...</pre>";

        $output = shell_exec("cd /var/www/{$appName} && sudo bash deploy.sh 2>&1");

        if (is_null($output)) {
            echo "<pre>Something went wrong while executing the deploy script.</pre>";
            return;
        }

        $this->database->insert('deploys', 'log', $output);

        echo "<pre>{$output}</pre>";

        $prettyName = ucfirst($appName);

        echo "<pre>{$prettyName} has been deployed successfully.</pre>";
    }
}