<?php namespace Partham\core;

class Deploy
{
    public static function invoke($appName)
    {
        $output = shell_exec("cd /var/www/{$appName} && bash deploy.sh 2>&1");

        /*sudo -u root -S bash deploy.sh 2>&1*/

        echo "<pre>{$output}</pre>";
    }
}