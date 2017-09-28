<?php namespace Partham\core\controllers;

class BaseController
{
    public static function view(string $fileName)
    {
        return readfile(__DIR__ . "/../views/{$fileName}.html");
    }
}