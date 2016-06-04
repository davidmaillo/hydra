<?php

// Includes vendor libraries
require "vendor/autoload.php";

use Hydra\Hydra;

define('APP_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
date_default_timezone_set("Europe/Madrid");

// Include configurations and global constants
$hydra = new Hydra(require "conf.php");