<?php

// load config

require_once 'config/config.php';
// загруска helpers

require_once 'helpers/helper.php';

// сессии

require_once 'helpers/session_helper.php';

// Autoload Core libraries
spl_autoload_register(function ($className) {
    require_once "libraries/" . $className .  ".php";
});
