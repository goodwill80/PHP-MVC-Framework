<?php 
// *** Order of files linkage 
// index.php  -->  bootstrap.php (all req files) --> 
// Core.php (routing of controller based on url params) --> relevent controllers 
// which extend to Controller.php to load both Views and Model

//1. Pass param via index.php in PUBLIC FOLDER
//2. Look in all required files in BOOTSTRAP.php
//3. Match params with relevent controllers via CORE.php
//4. Controllers (with extension to Controller.php in libraries) will then call either MODEL or VIEWS
//5. once models and views are loaded, it will return back to INDEX.PHP in PUBLIC FOLDER

    require_once "../app/bootstrap.php";

    // Init Core Library
    $init = new Core();

 