<?php
function my_autoloader($class) {
    include 'Classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

date_default_timezone_set('Asia/Dhaka');
