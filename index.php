<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require "vendor/autoload.php";
$dice =  new \Dice\Dice;
foreach (require "di/rules.php"  as $class => $rule) {
    $dice->addRule($class, $rule);
}

/** @var \AboutYou\Application $app */
$app = $dice->create(\AboutYou\Application::class);
$app->run();


