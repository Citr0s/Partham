<?php namespace Partham\Core;

class Deploy
{
    public static function invoke($appName)
    {
        $output = shell_exec('ls -lsa' /*"cd /var/www/{$appName} && sudo -u root -S bash deploy.sh 2>&1"*/);

        var_dump($output);
    }
}