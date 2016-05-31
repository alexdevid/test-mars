<?php
require_once __DIR__ . '/Service/Autoloader.php';
$loader = new \Service\Autoloader();
$loader->register();

echo (new \Controller\FormController())->indexAction();