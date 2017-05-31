<?php namespace Partham\core\controllers;

class WebController extends BaseController
{
    public static function index()
    {
        self::view('index');
    }
}