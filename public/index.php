<?php

use vcinsidedigital\Config;

require_once './vendor/autoload.php';
require_once './src/SlimConfiguration.php';
$config = new Config();
$config = $config->getConfig();
require_once './routes/index.php';