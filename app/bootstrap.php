<?php
// This file consolidate all required files needed for this app,
// and will be required once in index.php

// Load Config (Storing file directory, url addresses)
require_once 'config/config.php';

// Autoload Core Libraries
spl_autoload_register(function($className){
    require_once "libraries/" . $className . ".php";
});

