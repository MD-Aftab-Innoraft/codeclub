<?php

use App\Kernel;

// Include the autoloader for the application
require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

// Define a function that returns a new instance of the Kernel class
return function (array $context) {
    // Create a new instance of the Kernel class with the provided environment and debug mode
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};


