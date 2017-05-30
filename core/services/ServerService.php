<?php namespace Partham\core\services;

class ServerService
{
    public function getCpuUsage()
    {
        $cpuUsage = shell_exec("grep 'cpu ' /proc/stat | awk '{print ($2+$4)*100/($2+$4+$5)} END {print usage}'");
        return round((double)$cpuUsage, 2);
    }

    public function getMemoryUsage()
    {
        $memoryUsage = shell_exec("free");
        $memoryUsage = (string)trim($memoryUsage);
        $memoryUsage = explode("\n", $memoryUsage);
        $memoryUsage = explode(" ", $memoryUsage[1]);
        $memoryUsage = array_filter($memoryUsage);
        $memoryUsage = array_merge($memoryUsage);
        $memoryUsage = $memoryUsage[2] / $memoryUsage[1] * 100;

        return round($memoryUsage, 2);
    }

    public function info()
    {
        return [
            'cpu' => self::getCpuUsage(),
            'memory' => self::getMemoryUsage()
        ];
    }
}
