<?php namespace Partham\core\controllers;

class WebController extends BaseController
{
    public static function index()
    {
        self::view('index');
    }

    public static function logs()
    {
        self::view('logs');
    }

    public static function builds()
    {
        self::view('builds');
    }
}