<?php

require_once("Android.php");
$droid = new Android();

function chargerClasse($class){
require $class.'.class.php';
}spl_autoload_register('chargerClasse');


print_r(get_class_methods(new RobotStore()));
