<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configs = $_SERVER['argv'];
array_shift($configs);

$pullConf = new \RoundPartner\Conf\PullConf();
$pullConf->pull($configs);
